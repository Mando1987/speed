<?php

namespace App\Providers;

use App\Http\Services\GovernorateService;
use App\Models\Governorate;
use App\Providers\TelescopeServiceProvider;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{

    public function register()
    {
        //load manully this package
        if ($this->app->environment() !== 'production') {
            $this->app->register(\Barryvdh\LaravelIdeHelper\IdeHelperServiceProvider::class);
            // register Telescope package
            $this->app->register(\Laravel\Telescope\TelescopeServiceProvider::class);
            $this->app->register(TelescopeServiceProvider::class);
        }

        $this->app->singleton(Governorate::class, function ($app) {
            return (new Governorate);
        });

        $this->app->singleton(GovernorateService::class, function ($app) {
            return (new GovernorateService(new Governorate()));
        });

    }

    public function boot()
    {
        Schema::defaultStringLength(191);
    }

}
