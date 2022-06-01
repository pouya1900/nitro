<?php

namespace App\Http\Middleware\Api;


use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

/**
 * Class MapCamelCaseToSnakeCaseRequestMiddleware
 * @package App\Http\Middleware
 */
class MapCamelCaseToSnakeCaseRequestMiddleware
{
    /**
     *  change all input data key from camelCase to snake_case
     *
     * @param  Request  $request
     * @param Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
       foreach ($request->input() as $key => $input) {
           unset($request[$key]);
           $request->merge([Str::snake($key) => $input]);
       }

        return $next($request);
    }
}
