<?php

namespace App\Providers;

use App\Http\Interfaces\OrderRepositoryInterface;
use App\Http\Interfaces\OrderStoreFormRequestInterface;
use App\Http\Repositories\Orders\OrderRepository;
use App\Http\Requests\OrderStoreFormRequestRepository;
use Illuminate\Support\ServiceProvider;

class RepositoriesProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->bind(OrderStoreFormRequestInterface::class, OrderStoreFormRequestRepository::class);
        $this->app->bind(OrderRepositoryInterface::class, OrderRepository::class);
    }

    public function boot()
    {
        //
    }
}
