<?php

namespace App\Http\Middleware\Api;

use App\Traits\ResponseUtilsTrait;
use Closure;

class ForceUpdateMiddleware
{
    use ResponseUtilsTrait;

    public function handle($request, Closure $next, $guard = null)
    {
        if (
            empty($buildNumber = $request->header('build-number'))
            || $buildNumber !== env('APP_BUILD_NUMBER')
        ) {
            return $this->sendError(trans('apiMessages.auth.forceUpdateRequire'), config('responseCode.notAcceptable'));
        }
        return $next($request);
    }
}
