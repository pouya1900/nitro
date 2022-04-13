<?php

namespace App\Http\Middleware;

use Closure;

class CheckPermission
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next, ...$permission)
    {
        if(!auth()->check() || !$permission) {
            abort(403, 'عدم دسترسی');
        }

        if(
            empty(auth()->user()->hasPermission($permission)) &&
            empty(auth()->user()->isSuperAdmin())
        ) {
                abort(403, 'عدم دسترسی');
        }

        return $next($request);
    }
}
