<?php

namespace App\Providers;

use Storage;
use League\Flysystem\Filesystem;
use Illuminate\Support\ServiceProvider;
use Spatie\Dropbox\Client as DropboxClient;
use Spatie\FlysystemDropbox\DropboxAdapter;
use GrahamCampbell\GuzzleFactory\GuzzleFactory;
use GuzzleHttp\Client as GuzzleClient;

class DropboxServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        Storage::extend('dropbox', function ($app, $config) {

            $clientGuzzle = new GuzzleClient(['handler' => GuzzleFactory::handler() , 'verify' =>false]);
            $client = new DropboxClient(
                  $config['authorization_token'],
                 $clientGuzzle
            );
            return new Filesystem(new DropboxAdapter($client));
        });
    }
}



