<?php

namespace App\Http\Middleware;

use Closure;

class Language
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
        if(session()->has('lang') && !empty(session('lang'))){

            app()->setLocale(session('lang'));

        }else{
            
            app()->setLocale(config('app.locale'));
        }
        return $next($request);
    }
}
