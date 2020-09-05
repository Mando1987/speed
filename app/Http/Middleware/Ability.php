<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Gate;

class Ability
{
   
    public function handle($request, Closure $next)
    { 
        // return $next($request);
        
        if(Gate::allows(currentRouteName()) ) {
            
           return $next($request);

        }else{
            if ($request->expectsJson()){

                return response()->json(['code' => 2 ,
                'title'   => trans('site.failed_title') ,
                'message' => trans('site.no_ability')  ,
                   ]);
            }
            return abort(404);
        }

    }
}
