<?php

namespace App\Http\Middleware;

use Closure;

class InjectAdminIfAuthinticated
{
    public function handle($request, Closure $next)
    {
        $admin = auth('admin');
        if ($admin->check()) {
            $type = $admin->user()->type;
            $currentAdmin = $admin->user()->$type;
            $request->merge(
                [
                    'adminType' => $type,
                    'adminId' => $currentAdmin->id ?? $admin->id(),
                    'adminIsManager' => $type == 'manager' ? true:false,
                    'adminIsCustomer' => $type == 'customer' ? true:false,
                    'adminIsDelegate' => $type == 'delegate' ? true:false,
                ]
            );
        }
        return $next($request);
    }
}
