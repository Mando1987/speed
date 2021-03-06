<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Http\Repositories\ReciverRepository;
use App\Http\Interfaces\OrderRepositoryInterface;
use App\Http\Interfaces\PlaceRepositoryInterface;
use App\Http\Repositories\Orders\OrderRepository;
use App\Http\Repositories\Places\PlaceRepository;
use App\Http\Interfaces\ReciverRepositoryInterface;
use App\Http\Interfaces\CustomerRepositoryInterface;
use App\Http\Interfaces\DelegateRepositoryInterface;
use App\Http\Interfaces\ManagerRepositoryInterface;
use App\Http\Requests\OrderStoreFormRequestRepository;
use App\Http\Interfaces\OrderStoreFormRequestInterface;
use App\Http\Interfaces\PlacePricesRepositoryInterface;
use App\Http\Interfaces\ViewSettingRepositoryInterface;
use App\Http\Repositories\Customers\CustomerRepository;
use App\Http\Repositories\Delegates\DelegateRepository;
use App\Http\Repositories\Managers\ManagerRepository;
use App\Http\Repositories\Places\PlacePricesRepository;
use App\Http\Repositories\ViewSettingRepository;

class RepositoriesProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->bind(OrderStoreFormRequestInterface::class, OrderStoreFormRequestRepository::class);
        $this->app->bind(OrderRepositoryInterface::class, OrderRepository::class);
        $this->app->bind(PlaceRepositoryInterface::class, PlaceRepository::class);
        $this->app->bind(ReciverRepositoryInterface::class, ReciverRepository::class);
        $this->app->bind(CustomerRepositoryInterface::class, CustomerRepository::class);
        $this->app->bind(DelegateRepositoryInterface::class, DelegateRepository::class);
        $this->app->bind(PlacePricesRepositoryInterface::class, PlacePricesRepository::class);
        $this->app->bind(ViewSettingRepositoryInterface::class, ViewSettingRepository::class);
        $this->app->bind(ManagerRepositoryInterface::class,ManagerRepository::class);
    }

    public function boot()
    {

    }
}
