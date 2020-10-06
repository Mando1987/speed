<?php

namespace App\Http\Middleware;

use Closure;

class InjectAdminIfAuthinticated
{

    public function handle($request, Closure $next)
    {
        $admin = auth('admin');
        if ($admin->check()) {

            $request->merge(
                [
                    'adminId' => $admin->id(),
                    'adminType' => $admin->user()->type,
                ]
            );
        }
        return $next($request);
    }
}
