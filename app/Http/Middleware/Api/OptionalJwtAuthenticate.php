<?php

namespace App\Http\Middleware\Api;

use App\Models\User;
use App\Traits\ResponseUtilsTrait;
use Closure;
use Exception;
use Firebase\JWT\JWT;
use Firebase\JWT\ExpiredException;

class OptionalJwtAuthenticate
{
    use ResponseUtilsTrait;
    protected $user;

    public function __construct(User $user)
    {
        $this->user = $user;
    }

    public function handle($request, Closure $next, $guard = null)
    {
        try {
            if (empty($token = $request->header('Authorization'))) {
                return $next($request);
            }

            $credentials = JWT::decode($token, config('global.jwt.secretKey'), [config('global.jwt.cryptoMethod')]);
            if (
                empty($user = $this->user->find($credentials->sub))
                || $user->token !== $token
            ) {
                return $this->sendError(trans('apiMessages.auth.apiTokenInvalid'), config('responseCode.unauthorized'), config('responseCode.jwtFail'));
            }
            $request->user = $user;

        } catch (ExpiredException $e) {
            return $this->sendError(trans('apiMessages.auth.apiTokenExpired'), config('responseCode.unauthorized'), config('responseCode.jwtFail'));
        } catch (Exception $e) {
            return $this->sendError(trans('apiMessages.auth.apiTokenInvalid'), config('responseCode.unauthorized'), config('responseCode.jwtFail'));
        }

        return $next($request);
    }
}
