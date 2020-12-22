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
        $helperFilesDirectory = app_path() . DIRECTORY_SEPARATOR . 'Helper';
        $ignoredFiles = ['.', '..'];
        $helperFiles = array_diff(scandir($helperFilesDirectory), $ignoredFiles);

        foreach ($helperFiles as $file) {

            if (file_exists($file = $helperFilesDirectory . DIRECTORY_SEPARATOR . $file)) {
                require $file;
            }
        }
    }
}
