<?php

namespace App\Providers;

use App\Http\View\Composers\LanguageComposer;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class ComposerServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->singleton(LanguageComposer::class);
    }


    public function boot()
    {
        View::composer('*', LanguageComposer::class);
    }
}
