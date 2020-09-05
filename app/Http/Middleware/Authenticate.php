<?php

namespace App\Http\Middleware;

use Illuminate\Support\Facades\Request;
use Illuminate\Auth\Middleware\Authenticate as Middleware;

class Authenticate extends Middleware
{
    
    protected function redirectTo($request)
    {
        if (! $request->expectsJson()) {

            if(Request::is('admin/*') || Request::is('admin')){

                return route('admin.login');
            }else{
                return route('site.index');

            }
        }
        
    }
}
