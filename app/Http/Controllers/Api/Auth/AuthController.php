<?php

namespace App\Http\Controllers\Api\Auth;

use App\Events\SendOtpEvent;
use App\Http\Controllers\Api\Controller;
use App\Models\Activation;
use App\Models\User;
use App\Models\Role;
use App\Models\UserLogin;
use App\Models\Operator;
use App\Services\Sms\SmsServiceInterface;
use Firebase\JWT\JWT;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Str;

/**
 * Class AuthController
 * @package App\Http\Controllers\Auth
 */
class AuthController extends Controller
{
    /**
     * @var string
     */
    private $message;

    /**
     * @var Request
     */
    private $request;
    /**
     * @var SmsServiceInterface
     */
    private $smsHandler;

    /**
     * @var Activation
     */
    private $activation;

    /**
     * @var User
     */
    private $user;

    /**
     * @var UserLogin
     */
    private $userLogin;

    /**
     * AuthController constructor.
     *
     * @param Request $request
     * @param Activation $activation
     * @param UserLogin $userLogin
     * @param User $user
     * @param SmsServiceInterface $smsHandler
     */
    public function __construct(
        Request             $request,
        Activation          $activation,
        UserLogin           $userLogin,
        User                $user,
        SmsServiceInterface $smsHandler
    )
    {
        $this->request = $request;
        $this->activation = $activation;
        $this->userLogin = $userLogin;
        $this->user = $user;
        $this->smsHandler = $smsHandler;
        $this->message = '';
    }

    /**
     *  send otp to user mobile
     *
     * @return \Illuminate\Http\JsonResponse
     * @throws \Throwable
     */
    public function sendOtp()
    {
        $this->validateRequest(
            $this->request->input(), [
                'mobile'       => "required|numeric|digits_between:9,25",
                'country_code' => "required|numeric|digits_between:1,3|exists:countries,phone_code",
            ]
        );

        $mobile = $this->request->mobile;
        throw_if(!empty($this->isBlockedOtp($mobile)), new \Exception(trans('apiMessages.auth.otpBlock')));

        // make and send otp
        Event::dispatch(new SendOtpEvent(makeMobileByZero($mobile), $this->request->country_code, $this->smsHandler));

        $data = [
            'expiredSeconds' => config('global.otp.expiredSeconds'),
            'mobile'         => $mobile,
        ];

        return $this->sendResponse($data, trans('apiMessages.auth.activationCodeSent'));
    }

    /**
     * login by otp and mobile
     *
     * @return \Illuminate\Http\JsonResponse
     * @throws \App\Exceptions\AppException
     */
    public function login()
    {


        $this->validateRequest($this->request->input(), [
            'activation_code' => 'required|numeric|digits:6',
            'mobile'          => "required|numeric|digits_between:9,25|exists:activations,mobile",
            'country_code'    => 'required|exists:countries,phone_code',
            'uuid'            => 'required|string|min:30|max:60',
            'platform'        => 'required|string|in:mobile,web',
            'model'           => 'required|string|min:3|max:50',
            'os'              => 'required|string|min:3|max:50',
        ]);

        // check if user is blocked
        $mobile = makeMobileWithoutZero($this->request->mobile);
        $uuid = $this->request->uuid;

        // plus retry time
        $this->activation->updateRetryInfoByMobile($mobile);

        if (!empty($this->isBlockedOtp($mobile))) {
            return $this->sendError(trans('apiMessages.auth.otpBlock'), config('responseCode.validationFail'));
        }
        $activation = $this->activation->getUncompletedByCodeMobile($this->request->activation_code, $this->request->mobile);

        if (empty($activation)) {
            return $this->sendError(trans('apiMessages.auth.activationCodeInvalid'), config('responseCode.badRequest'));
        }

        DB::beginTransaction();
        $standard_user = Role::where('name', 'standardUser')->get()->first()->id;

        if (!$user = User::where('mobile', "$mobile")->first()) {

            $code = substr($mobile, 0, 3);
            $operator = Operator::where('code', $code)->first();
            $user = User::create([
                'mobile'          => $mobile,
                'phone_code'      => $this->request->country_code,
                'role_id'         => $standard_user,
                'mobile_type'     => $operator->type,
            ]);

        }


        UserLogin::where('uuid', $uuid)->update([
            'is_active' => false,
            'logout_at' => Carbon::now(),
        ]);

        if (empty($userToken = $this->getUserToken($user))) {
            return $this->sendError(trans('apiMessages.auth.makeUserTokenFail'), config('responseCode.badRequest'));
        }

        $activation->update([
            'completed_at' => Carbon::now(),
        ]);

        $user->update([
            'mobile_verified_at' => Carbon::now(),
            'token'              => $userToken,
        ]);

        $this->userLogin->syncUserLoginInfo($user->id, [
            'platform'       => $this->request->platform,
            'model'          => $this->request->model,
            'os'             => $this->request->os,
            'uuid'           => $this->request->uuid,
            'firebase_token' => $this->request->firebase_token,
            'is_active'      => true,
            'login_at'       => Carbon::now(),
            'created_at'     => Carbon::now(),
        ]);

        DB::commit();

        $data = [
            'userToken'  => $userToken,
        ];

        return $this->sendResponse($data);
    }



    /**
     *  logout user and clear token
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function logout()
    {
        DB::beginTransaction();
        $this->user->removeUserToken($this->request->user->id);
        $this->userLogin->deactiveUserLogin($this->request->user->id);
        DB::commit();

        return $this->sendResponse([], trans('apiMessages.auth.logOutSuccess'));
    }

    /**
     *  get user jwt token
     *
     * @param $user
     *
     * @return string
     */
    private function getUserToken($user)
    {
        $userToken = $user->token;
        if (empty($userToken)) {
            return $this->createJwtToken($user);
        }
        try {
            JWT::decode($userToken, config('global.jwt.secretKey'), [config('global.jwt.cryptoMethod')]);
        } catch (Exception $e) {
            return $this->createJwtToken($user);
        }

        return $userToken;
    }

    /**
     * create jwt token for user
     *
     * @param $user
     *
     * @return string
     */
    private function createJwtToken($user)
    {
        $payload = [
            'iss'      => config('global.jwt.iss'), // Issuer of the token
            'sub'      => $user->id, // Subject of the token
            'roleId'   => empty($user->role) ? null : $user->role->id,
            'roleName' => empty($user->role) ? null : $user->role->name,
            'iat'      => time(), // Time when JWT was issued.
            'exp'      => config('global.jwt.exp'),
        ];
        return JWT::encode($payload, config('global.jwt.secretKey'), config('global.jwt.cryptoMethod'));
    }

    /**
     * @param $user
     *
     * @return bool
     */

    /**
     * @param int $mobile
     *
     * @return bool|mixed
     */
    private function isBlockedOtp(int $mobile)
    {
        $code = $this->activation->getUncompletedByMobile($mobile);
        if (
            !empty($code)
            && $code->retry_time >= config('global.otp.retryTime')
            && !empty($code->retry_at)

            && Carbon::parse($code->retry_at)->addSeconds(config('global.otp.blockInterupt')) > Carbon::now()
        ) {
            return $code;
        }

        return false;
    }


}
