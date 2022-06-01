<?php

namespace App\Listeners;

use App\Events\SendOtpEvent;
use App\Exceptions\AppException;
use App\Models\Activation;
use Carbon\Carbon;

/**
 * Class SendOtpEventListener
 * @package App\Listeners
 */
class SendOtpEventListener
{

    private $activation;

    /**
     * SendOtpEventListener constructor.
     * @param Activation $activation
     */
    public function __construct(Activation $activation)
    {
        $this->activation = $activation;
    }

    /**
     * @param SendOtpEvent $event
     * @throws \Throwable
     */
    public function handle(SendOtpEvent $event)
    {
        if(empty($this->activation->canSend($event->mobile)))
            throw new AppException(trans('apiMessages.auth.activationCodeWaitTimeFail', ['time' => config('global.otp.expiredSeconds')])
        );

        $activationCode = $this->makeActivationCode($event->mobile);

        // make otp record
        $this->activation->create(
            [
                'mobile' => $event->mobile,
                'code' => $activationCode,
                'country_code' => $event->countryCode,
                'expired_at' => Carbon::now()->addSeconds(config('global.otp.expiredSeconds'))->format('Y-m-d H:i:s')
            ]
        );

        // send sms code
        $sendState = $event->smsHandler->sendOtp($event->countryCode , $event->mobile, $activationCode);

        if(!$sendState) {
            throw new AppException(trans('apiMessages.auth.activationCodeSendFail'));
        }
    }

    /**
     * @param $mobile
     * @return int|mixed
     */
    private function makeActivationCode($mobile)
    {
        do{
            $activationCode = mt_rand(config('global.otp.minRange', ''), config('global.otp.maxRange'));
        }while(!empty($this->activation->getUncompletedByCodeMobile($activationCode, $mobile)));

        return $activationCode;
    }

}
