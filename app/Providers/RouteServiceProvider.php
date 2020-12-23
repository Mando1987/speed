<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Route;

class RouteServiceProvider extends ServiceProvider
{
    /**
     * This namespace is applied to your controller routes.
     *
     * In addition, it is set as the URL generator's root namespace.
     *
     * @var string
     */
    protected $namespace = 'App\Http\Controllers';
    protected $adminNamespace = 'App\Http\Controllers\Admin';
    protected $adminAuthNamespace = 'App\Http\Controllers\Admin\Auth';

    private $adminMiddleWares = ['web', 'lang', 'auth:admin'];

    /**
     * The path to the "home" route for your application.
     *
     * @var string
     */
    public const HOME = '/';

    public const DASHBOARD = '/dashboard';

    /**
     * Define your route model bindings, pattern filters, etc.
     *
     * @return void
     */
    public function boot()
    {

        Route::pattern('id', '[0-9]+');
        parent::boot();
    }

    /**
     * Define the routes for the application.
     *
     * @return void
     */
    public function map()
    {
        $this->mapApiRoutes();

        $this->mapWebRoutes();
        $this->mapAdminAuthRoutes();
        $this->mapAdminWebRoutes();
        $this->mapOrderRoutes();

        //
    }

    protected function mapWebRoutes()
    {
        Route::middleware('web')
            ->namespace($this->namespace)
            ->group(base_path('routes/web.php'));
    }
    protected function mapOrderRoutes()
    {
        Route::middleware($this->adminMiddleWares)// 'ability'
            ->group(base_path('routes/admin/order.php'));
    }

    protected function mapAdminAuthRoutes()
    {
        Route::middleware(['web', 'lang'])
            ->namespace($this->adminAuthNamespace)
            ->group(base_path('routes/admin/auth.php'));
    }

    protected function mapAdminWebRoutes()
    {
        Route::middleware($this->adminMiddleWares)// 'ability'
            ->group(base_path('routes/admin/web.php'));
    }

    protected function mapApiRoutes()
    {
        Route::prefix('api')
            ->middleware('api')
            ->namespace($this->namespace)
            ->group(base_path('routes/api.php'));
    }
}
