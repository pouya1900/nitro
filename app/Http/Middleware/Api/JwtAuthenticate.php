<?php

namespace App\Http\Middleware\Api;

use App\Exceptions\AppException;
use App\Traits\ResponseUtilsTrait;
use Firebase\JWT\ExpiredException;
use Firebase\JWT\JWT;
use App\Models\User;
use Closure;

class JwtAuthenticate
{
    use ResponseUtilsTrait;

    protected $user;

    public function __construct(User $user)
    {
        $this->user = $user;
    }

    public function handle($request, Closure $next)
    {
        try {

            if (empty($token = $request->header('Authorization'))) {
                throw new AppException(trans('messages.auth.apiTokenRequired'), config('responseCode.unauthorized'), config('responseCode.jwtFail'));
            }

            $credentials = JWT::decode($token, config('global.jwt.secretKey'), [config('global.jwt.cryptoMethod')]);



            if (
                empty($user = $this->user->find($credentials->sub))
                || $user->token !== $token
            ) {
                throw new AppException(trans('messages.auth.apiTokenInvalid'), config('responseCode.unauthorized'), config('responseCode.jwtFail'));
            }
            $request->user = $user;

        } catch (ExpiredException $e) {
            throw new AppException(trans('messages.auth.apiTokenExpired'), config('responseCode.unauthorized'), config('responseCode.jwtFail'));
        }
        catch (\Exception $e){

            throw new AppException(trans('messages.auth.apiTokenInvalid'), config('responseCode.unauthorized'), config('responseCode.jwtFail'));
        }

        return $next($request);
    }
}
