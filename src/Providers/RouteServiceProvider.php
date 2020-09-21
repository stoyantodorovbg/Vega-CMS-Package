<?php

namespace Vegacms\Cms\Providers;

use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;

class RouteServiceProvider extends ServiceProvider
{
    /**
     * This namespace is applied to your controller routes.
     *
     * In addition, it is set as the URL generator's root namespace.
     *
     * @var string
     */
    protected $namespace = null;

    /**
     * Define your route model bindings, pattern filters, etc.
     *
     * @return void
     */
    public function boot()
    {
        parent::boot();
    }

    /**
     * Define the routes for the application.
     *
     * @return void
     */
    public function map()
    {
        $this->mapPagesRoutes();

        $this->mapAdminRoutes();

        $this->mapVegaWebRoutes();

        $this->mapVegaApiRoutes();
    }

    /**
     * Define the "pages" routes for the application.
     *
     * These routes are typically stateless.
     *
     * @return void
     */
    protected function mapVegaWebRoutes()
    {
        Route::middleware('web')
            ->group(base_path() . '/routes/vega-web.php');
    }

    /**
     * Define the "pages" routes for the application.
     *
     * These routes are typically stateless.
     *
     * @return void
     */
    protected function mapVegaApiRoutes()
    {
        Route::middleware('web')
            ->group(base_path() . '/routes/vega-api.php');
    }

    /**
     * Define the "pages" routes for the application.
     *
     * These routes are typically stateless.
     *
     * @return void
     */
    protected function mapPagesRoutes()
    {
        Route::middleware('web')
            ->group(base_path() . '/routes/page.php');
    }

    /**
     * Define the "admin" routes for the application.
     *
     * These routes are typically stateless.
     *
     * @return void
     */
    protected function mapAdminRoutes()
    {
        Route::prefix('admin')
            ->middleware('web')
            ->group(base_path() . '/routes/admin.php');
    }
}
