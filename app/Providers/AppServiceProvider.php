<?php

namespace App\Providers;

use App\DryClasses\GovernorateClass;
use App\Models\Admin;
use App\Models\City;
use App\Models\Governorate;
use Illuminate\Support\Facades\App;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{

    public function register()
    {
        //load manully this package
        if ($this->app->environment() !== 'production') {
            $this->app->register(\Barryvdh\LaravelIdeHelper\IdeHelperServiceProvider::class);
        }

        $this->app->singleton(Governorate::class, function ($app) {
            return (new Governorate);
        });

        $this->app->singleton(GovernorateClass::class, function ($app) {
            return (new GovernorateClass(new Governorate, new City));
        });

    }

    public function boot()
    {

    }

}
