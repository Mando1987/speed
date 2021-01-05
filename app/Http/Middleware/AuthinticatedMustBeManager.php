<?php

namespace App\Http\Middleware;

use Closure;

class AuthinticatedMustBeManager
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
        if (auth('admin')->check() && auth('admin')->user()->type == 'manager') {
            return $next($request);
        }
        return abort(404);
    }
}
