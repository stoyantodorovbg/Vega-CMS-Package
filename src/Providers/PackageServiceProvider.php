<?php

namespace Vegacms\Cms\Providers;

use Vegacms\Cms\Models\Page;
use Vegacms\Cms\Services\RouteService;
use Vegacms\Cms\Services\GroupService;
use Vegacms\Cms\Http\Middleware\Locale;
use Vegacms\Cms\Services\LocaleService;
use Vegacms\Cms\Services\PhraseService;
use Vegacms\Cms\Observers\PageObserver;
use Vegacms\Cms\Services\MessageService;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Artisan;
use Vegacms\Cms\DataMappers\PageDataMapper;
use Vegacms\Cms\DataMappers\MenuDataMapper;
use Vegacms\Cms\Services\FileCreateService;
use Vegacms\Cms\Services\ValidationService;
use Vegacms\Cms\Repositories\DataRepository;
use Vegacms\Cms\Console\Commands\SyncRoutes;
use Vegacms\Cms\Repositories\BaseRepository;
use Vegacms\Cms\Services\FileDestroyService;
use Vegacms\Cms\Repositories\GroupRepository;
use Vegacms\Cms\Repositories\RouteRepository;
use Vegacms\Cms\Repositories\LocaleRepository;
use Vegacms\Cms\Console\Commands\DestroyGroup;
use Vegacms\Cms\Console\Commands\DestroyRoute;
use Vegacms\Cms\Console\Commands\GenerateGroup;
use Vegacms\Cms\Console\Commands\GenerateRoute;
use Vegacms\Cms\Services\EloquentFilterService;
use Vegacms\Cms\DataMappers\ContainerDataMapper;
use Vegacms\Cms\DataMappers\DataMapperInterface;
use Vegacms\Cms\Console\Commands\IntegrateVegaCms;
use Vegacms\Cms\Console\Commands\AttachRouteToGroup;
use Vegacms\Cms\Console\Commands\DetachRouteFromGroup;
use Vegacms\Cms\Http\Controllers\Admin\PagesController;
use Vegacms\Cms\Http\Controllers\Admin\MenusController;
use Vegacms\Cms\Console\Commands\IntegrateVegaCmsTesting;
use Vegacms\Cms\Services\Interfaces\GroupServiceInterface;
use Vegacms\Cms\Services\Interfaces\RouteServiceInterface;
use Vegacms\Cms\Services\Interfaces\LocaleServiceInterface;
use Vegacms\Cms\Services\Interfaces\PhraseServiceInterface;
use Vegacms\Cms\Http\Controllers\Admin\ContainersController;
use Vegacms\Cms\Repositories\DefaultJsonStructureRepository;
use Vegacms\Cms\Services\Interfaces\MessageServiceInterface;
use Vegacms\Cms\Services\Interfaces\FileCreateServiceInterface;
use Vegacms\Cms\Services\Interfaces\ValidationServiceInterface;
use Vegacms\Cms\Repositories\Interfaces\DataRepositoryInterface;
use Vegacms\Cms\Repositories\Interfaces\BaseRepositoryInterface;
use Vegacms\Cms\Services\Interfaces\FileDestroyServiceInterface;
use Vegacms\Cms\Repositories\Interfaces\GroupRepositoryInterface;
use Vegacms\Cms\Repositories\Interfaces\RouteRepositoryInterface;
use Vegacms\Cms\Repositories\Interfaces\LocaleRepositoryInterface;
use Vegacms\Cms\Services\Interfaces\EloquentFilterServiceInterface;
use Vegacms\Cms\Repositories\Interfaces\DefaultJsonStructureRepositoryInterface;

class PackageServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->loadViewsFrom(__DIR__ . '/../../resources/views', 'vegacms');

//        $this->loadMigrationsFrom(__DIR__ . '/../../database/migrations');
//
//        $this->loadFactoriesFrom(__DIR__ . '/../../database/factories');

        $this->publishes([
            __DIR__ . '/../../resources/views' => resource_path('views/vendor/vegacms'),
        ], 'vegacms-views');

        $this->publishes([
            __DIR__ . '/../../config/cms.php' => config_path('cms.php'),
        ], 'vegacms-config');

        $this->publishes([
            __DIR__ . '/../../database/migrations/' => database_path('migrations')
        ], 'vegacms-migrations');

        $this->publishes([
            __DIR__ . '/../../database/seeders/' => database_path('seeds')
        ], 'vegacms-seeds');

        $this->publishes([
            __DIR__ . '/../../database/factories' => database_path('factories')
        ], 'vegacms-factories');

        $this->publishes([
            __DIR__ . '/../../resources/js' => resource_path('assets/js'),
        ], 'vegacms-assets-js');

        $this->publishes([
            __DIR__ . '/../../resources/sass' => resource_path('assets/sass'),
        ], 'vegacms-assets-sass');

        $this->registerSeedsFrom();

        if ($this->app->runningInConsole()) {
            $this->commands([
                AttachRouteToGroup::class,
                DestroyGroup::class,
                DestroyRoute::class,
                DetachRouteFromGroup::class,
                GenerateGroup::class,
                GenerateRoute::class,
                SyncRoutes::class,
                IntegrateVegaCms::class,
                IntegrateVegaCmsTesting::class,
            ]);
        }

        Page::observe(PageObserver::class);
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register(): void
    {
        $this->app->register(RouteServiceProvider::class);

        // Services
        $this->app->bind(RouteServiceInterface::class, RouteService::class);
        $this->app->bind(ValidationServiceInterface::class, ValidationService::class);
        $this->app->bind(GroupServiceInterface::class, GroupService::class);
        $this->app->bind(FileCreateServiceInterface::class, FileCreateService::class);
        $this->app->bind(FileDestroyServiceInterface::class, FileDestroyService::class);
        $this->app->bind(LocaleServiceInterface::class, LocaleService::class);
        $this->app->bind(MessageServiceInterface::class, MessageService::class);
        $this->app->bind(PhraseServiceInterface::class, PhraseService::class);
        $this->app->bind(EloquentFilterServiceInterface::class, EloquentFilterService::class);

        // Repositories
        $this->app->bind(GroupRepositoryInterface::class, GroupRepository::class);
        $this->app->bind(BaseRepositoryInterface::class, BaseRepository::class);
        $this->app->bind(RouteRepositoryInterface::class, RouteRepository::class);
        $this->app->bind(DefaultJsonStructureRepositoryInterface::class, DefaultJsonStructureRepository::class);
        $this->app->bind(LocaleRepositoryInterface::class, LocaleRepository::class);
        $this->app->bind(DataRepositoryInterface::class, DataRepository::class);

        // Data Mappers
        $this->app->when(PagesController::class)
            ->needs(DataMapperInterface::class)
            ->give(PageDataMapper::class);
        $this->app->when(ContainersController::class)
            ->needs(DataMapperInterface::class)
            ->give(ContainerDataMapper::class);
        $this->app->when(MenusController::class)
            ->needs(DataMapperInterface::class)
            ->give(MenuDataMapper::class);

        $this->app['router']->aliasMiddleware('locale', Locale::class);
    }

    /**
     * Register seeds.
     *
     * @return void
     */
    protected function registerSeedsFrom()
    {
        $command = request()->server('argv', null);
        if (is_array($command)) {
            $command = implode(' ', $command);
            if ($command === 'artisan db:seed' || $command === 'artisan migrate:fresh --seed') {
                Artisan::call('db:seed', ['--class' => 'Vegacms\Cms\Database\Seeders\VegaCmsDatabaseSeeder']);
            }
        }
    }
}
