<?php

namespace App\Http\Middleware;

use App\Http\Interfaces\OrderRepositoryInterface;
use App\Http\Interfaces\OrderStoreFormRequestInterface;
use App\Http\Repositories\Orders\OrderRepositoryByManager;
use App\Http\Requests\OrderStoreFormRequestByCustomer;
use App\Http\Requests\OrderStoreFormRequestByManager;
use Closure;

class RegisterRepositoriesIfAdminAuthinticated
{
    private $registerdRepositories = [
        [
            'interface' => OrderStoreFormRequestInterface::class,
            'repositories' => [
                'manager' => OrderStoreFormRequestByManager::class,
                'customer' => OrderStoreFormRequestByCustomer::class,
            ],
        ],
        [
            'interface' => OrderRepositoryInterface::class,
            'repositories' => [
                'manager' => OrderRepositoryByManager::class,
                // 'customer' => OrderStoreFormRequestByCustomer::class,
            ],
        ],

    ];

    public function handle($request, Closure $next)
    {
        // if ($request->adminType) {

        //     foreach ($this->registerdRepositories as $RegisterRepository) {

        //         $repoClass = array_key_exists($request->adminType, $RegisterRepository['repositories']) ?
        //         $RegisterRepository['repositories'][$request->adminType] :
        //         $RegisterRepository['repositories']['manager'];
        //         app()->bind($RegisterRepository['interface'], $repoClass);
        //     }

        // }
        return $next($request);
    }
}
