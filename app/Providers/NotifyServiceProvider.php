<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class NotifyServiceProvider extends ServiceProvider
{
    
    public function register()
    {
        
    }
    public function boot()
    {
        $this->registerHelpers();
    }
    public function registerHelpers()
    {
        define('DS' , DIRECTORY_SEPARATOR);

        if (file_exists($file = __DIR__ . DS . '..' . DS . 'Helper' . DS . 'Notify.php')) {
            
            require $file;
        }
        
    }
}
