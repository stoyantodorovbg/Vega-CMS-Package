<?php

namespace Vegacms\Cms\Providers;

use Vegacms\Cms\Models\Page;
use Vegacms\Cms\Services\RouteService;
use Vegacms\Cms\Services\GroupService;
use Vegacms\Cms\Observers\PageObserver;
use Vegacms\Cms\Services\PhraseService;
use Vegacms\Cms\Services\LocaleService;
use Vegacms\Cms\Services\MessageService;
use Vegacms\Cms\DataMappers\MenuDataMapper;
use Vegacms\Cms\DataMappers\PageDataMapper;
use Vegacms\Cms\Services\FileCreateService;
use Vegacms\Cms\Services\ValidationService;
use Vegacms\Cms\Repositories\BaseRepository;
use Vegacms\Cms\Services\FileDestroyService;
use Vegacms\Cms\Repositories\RouteRepository;
use Vegacms\Cms\Repositories\GroupRepository;
use Illuminate\Support\ServiceProvider;
use Vegacms\Cms\Services\EloquentFilterService;
use Vegacms\Cms\DataMappers\ContainerDataMapper;
use Vegacms\Cms\DataMappers\DataMapperInterface;
use Vegacms\Cms\Http\Controllers\Admin\MenusController;
use Vegacms\Cms\Http\Controllers\Admin\PagesController;
use Vegacms\Cms\Services\Interfaces\GroupServiceInterface;
use Vegacms\Cms\Services\Interfaces\RouteServiceInterface;
use Vegacms\Cms\Services\Interfaces\PhraseServiceInterface;
use Vegacms\Cms\Services\Interfaces\LocaleServiceInterface;
use Vegacms\Cms\Http\Controllers\Admin\ContainersController;
use Vegacms\Cms\Repositories\DefaultJsonStructureRepository;
use Vegacms\Cms\Services\Interfaces\MessageServiceInterface;
use Vegacms\Cms\Services\Interfaces\FileCreateServiceInterface;
use Vegacms\Cms\Services\Interfaces\ValidationServiceInterface;
use Vegacms\Cms\Repositories\Interfaces\BaseRepositoryInterface;
use Vegacms\Cms\Services\Interfaces\FileDestroyServiceInterface;
use Vegacms\Cms\Repositories\Interfaces\GroupRepositoryInterface;
use Vegacms\Cms\Repositories\Interfaces\RouteRepositoryInterface;
use Vegacms\Cms\Services\Interfaces\EloquentFilterServiceInterface;
use Vegacms\Cms\Repositories\Interfaces\DefaultJsonStructureRepositoryInterface;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register(): void
    {

    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot(): void
    {
    }
}
