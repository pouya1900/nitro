<?php

namespace App\Http\Middleware\Api;

use Closure;

class CorsOriginMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        header('Access-Control-Allow-Origin: *');
        if($request->getMethod() == 'OPTIONS'){
            header('Access-Control-Allow-Methods: POST, GET, OPTIONS, PUT, DELETE');
//            header('Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept, Key, Authorization');
            header('Access-Control-Allow-Headers: *');
            header('Access-Control-Allow-Credentials: true');
            exit(0);
        }

        return $next($request);
    }
}
