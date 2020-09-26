<?php

namespace Vegacms\Cms\Database\Seeders;

use Vegacms\Cms\Models\Group;
use Vegacms\Cms\Models\Route;
use Illuminate\Database\Seeder;
use Vegacms\Cms\Services\Interfaces\RouteServiceInterface;

class RoutesTableSeeder extends Seeder
{
    /**
     * @var RouteServiceInterface
     */
    protected $routeService;

    /**
     * GroupsTableSeeder constructor.
     * @param RouteServiceInterface $routeService
     */
    public function __construct(RouteServiceInterface $routeService)
    {
        $this->routeService = $routeService;
    }

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        // Ordinary user home page
        $this->createRoute('/home',
            'get',
            'VegaCmsHomeController@index',
            'home',
            'vega-web',
            'front',
            'ordinaryUsers',
            '\Vegacms\Cms\Http\Controllers\\'
        );

        // Admin dashboards index
        $this->createRoute('/dashboard',
            'get',
            'DashboardsController@index',
            'admin-dashboards.index',
            'admin',
            'admin',
            'admins',
            '\Vegacms\Cms\Http\Controllers\\'
        );

        // Admin dashboards home
        $this->createRoute('/',
            'get',
            'DashboardsController@home',
            'admin-dashboards.home',
            'admin',
            'admin',
            'admins',
            '\Vegacms\Cms\Http\Controllers\\'
        );

        // Admin groups index
        $this->createRoute('/groups',
            'get',
            'GroupsController@index',
            'admin-groups.index',
            'admin',
            'admin',
            'admins',
            '\Vegacms\Cms\Http\Controllers\\'
        );

        // Admin groups create
        $this->createRoute('/groups/create',
            'get',
            'GroupsController@create',
            'admin-groups.create',
            'admin',
            'admin',
            'admins',
            '\Vegacms\Cms\Http\Controllers\\'
        );

        // Admin groups show
        $this->createRoute('/groups/{group}',
            'get',
            'GroupsController@show',
            'admin-groups.show',
            'admin',
            'admin',
            'admins',
            '\Vegacms\Cms\Http\Controllers\\'
        );

        // Admin groups store
        $this->createRoute('/groups/store',
            'post',
            'GroupsController@store',
            'admin-groups.store',
            'admin',
            'admin',
            'admins',
            '\Vegacms\Cms\Http\Controllers\\'
        );

//        // Admin groups edit
//        $this->createRoute('/groups/{group}/edit',
//            'get',
//            'GroupsController@edit',
//            'admin-groups.edit',
//            'admin',
//            'admin',
//            'admins'
//        );
//
//        // Admin groups update
//        $this->createRoute('/groups/{group}/update',
//            'patch',
//            'GroupsController@update',
//            'admin-groups.update',
//            'admin',
//            'admin',
//            'admins'
//        );

        // Admin users index
        $this->createRoute('/users',
            'get',
            'UsersController@index',
            'admin-users.index',
            'admin',
            'admin',
            'admins',
            '\Vegacms\Cms\Http\Controllers\\'
        );

        // Admin users create
        $this->createRoute('/users/create',
            'get',
            'UsersController@create',
            'admin-users.create',
            'admin',
            'admin',
            'admins',
            '\Vegacms\Cms\Http\Controllers\\'
        );

        // Admin users show
        $this->createRoute('/users/{user}',
            'get',
            'UsersController@show',
            'admin-users.show',
            'admin',
            'admin',
            'admins',
            '\Vegacms\Cms\Http\Controllers\\'
        );

        // Admin users store
        $this->createRoute('/users/store',
            'post',
            'UsersController@store',
            'admin-users.store',
            'admin',
            'admin',
            'admins',
            '\Vegacms\Cms\Http\Controllers\\'
        );

        // Admin users edit
        $this->createRoute('/users/{user}/edit',
            'get',
            'UsersController@edit',
            'admin-users.edit',
            'admin',
            'admin',
            'admins',
            '\Vegacms\Cms\Http\Controllers\\'
        );

        // Admin users update
        $this->createRoute('/users/{user}/update',
            'patch',
            'UsersController@update',
            'admin-users.update',
            'admin',
            'admin',
            'admins',
            '\Vegacms\Cms\Http\Controllers\\'
        );

        // Admin phrases index
        $this->createRoute('/phrases',
            'get',
            'PhrasesController@index',
            'admin-phrases.index',
            'admin',
            'admin',
            'admins',
            '\Vegacms\Cms\Http\Controllers\\'
        );

        // Admin phrases create
        $this->createRoute('/phrases/create',
            'get',
            'PhrasesController@create',
            'admin-phrases.create',
            'admin',
            'admin',
            'admins',
            '\Vegacms\Cms\Http\Controllers\\'
        );

        // Admin phrases show
        $this->createRoute('/phrases/{phrase}',
            'get',
            'PhrasesController@show',
            'admin-phrases.show',
            'admin',
            'admin',
            'admins',
            '\Vegacms\Cms\Http\Controllers\\'
        );

        // Admin phrases store
        $this->createRoute('/phrases/store',
            'post',
            'PhrasesController@store',
            'admin-phrases.store',
            'admin',
            'admin',
            'admins',
            '\Vegacms\Cms\Http\Controllers\\'
        );

        // Admin phrases edit
        $this->createRoute('/phrases/{phrase}/edit',
            'get',
            'PhrasesController@edit',
            'admin-phrases.edit',
            'admin',
            'admin',
            'admins',
            '\Vegacms\Cms\Http\Controllers\\'
        );

        // Admin phrases update
        $this->createRoute('/phrases/{phrase}/update',
            'patch',
            'PhrasesController@update',
            'admin-phrases.update',
            'admin',
            'admin',
            'admins',
            '\Vegacms\Cms\Http\Controllers\\'
        );

        // Admin locales index
        $this->createRoute('/locales',
            'get',
            'LocalesController@index',
            'admin-locales.index',
            'admin',
            'admin',
            'admins',
            '\Vegacms\Cms\Http\Controllers\\'
        );

        // Admin locales create
        $this->createRoute('/locales/create',
            'get',
            'LocalesController@create',
            'admin-locales.create',
            'admin',
            'admin',
            'admins',
            '\Vegacms\Cms\Http\Controllers\\'
        );

        // Admin locales show
        $this->createRoute('/locales/{locale}',
            'get',
            'LocalesController@show',
            'admin-locales.show',
            'admin',
            'admin',
            'admins',
            '\Vegacms\Cms\Http\Controllers\\'
        );

        // Admin locales store
        $this->createRoute('/locales/store',
            'post',
            'LocalesController@store',
            'admin-locales.store',
            'admin',
            'admin',
            'admins',
            '\Vegacms\Cms\Http\Controllers\\'
        );

        // Admin locales edit
        $this->createRoute('/locales/{locale}/edit',
            'get',
            'LocalesController@edit',
            'admin-locales.edit',
            'admin',
            'admin',
            'admins',
            '\Vegacms\Cms\Http\Controllers\\'
        );

        // Admin locales update
        $this->createRoute('/locales/{locale}/update',
            'patch',
            'LocalesController@update',
            'admin-locales.update',
            'admin',
            'admin',
            'admins',
            '\Vegacms\Cms\Http\Controllers\\'
        );

        // Admin routes index
        $this->createRoute('/routes',
            'get',
            'RoutesController@index',
            'admin-routes.index',
            'admin',
            'admin',
            'admins',
            '\Vegacms\Cms\Http\Controllers\\'
        );

        // Admin routes create
        $this->createRoute('/routes/create',
            'get',
            'RoutesController@create',
            'admin-routes.create',
            'admin',
            'admin',
            'admins',
            '\Vegacms\Cms\Http\Controllers\\'
        );

        // Admin routes show
        $this->createRoute('/routes/{route}',
            'get',
            'RoutesController@show',
            'admin-routes.show',
            'admin',
            'admin',
            'admins',
            '\Vegacms\Cms\Http\Controllers\\'
        );

        // Admin routes store
        $this->createRoute('/routes/store',
            'post',
            'RoutesController@store',
            'admin-routes.store',
            'admin',
            'admin',
            'admins',
            '\Vegacms\Cms\Http\Controllers\\'
        );

        // Admin routes edit
        $this->createRoute('/routes/{route}/edit',
            'get',
            'RoutesController@edit',
            'admin-routes.edit',
            'admin',
            'admin',
            'admins',
            '\Vegacms\Cms\Http\Controllers\\'
        );

        // Admin routes update
        $this->createRoute('/routes/{route}/update',
            'patch',
            'RoutesController@update',
            'admin-routes.update',
            'admin',
            'admin',
            'admins',
            '\Vegacms\Cms\Http\Controllers\\'
        );

        // Admin menus index
        $this->createRoute('/menus',
            'get',
            'MenusController@index',
            'admin-menus.index',
            'admin',
            'admin',
            'admins',
            '\Vegacms\Cms\Http\Controllers\\'
        );

        // Admin menus create
        $this->createRoute('/menus/create',
            'get',
            'MenusController@create',
            'admin-menus.create',
            'admin',
            'admin',
            'admins',
            '\Vegacms\Cms\Http\Controllers\\'
        );

        // Admin menus show
        $this->createRoute('/menus/{menu}',
            'get',
            'MenusController@show',
            'admin-menus.show',
            'admin',
            'admin',
            'admins',
            '\Vegacms\Cms\Http\Controllers\\'
        );

        // Admin menus store
        $this->createRoute('/menus/store',
            'post',
            'MenusController@store',
            'admin-menus.store',
            'admin',
            'admin',
            'admins',
            '\Vegacms\Cms\Http\Controllers\\'
        );

        // Admin menus edit
        $this->createRoute('/menus/{menu}/edit',
            'get',
            'MenusController@edit',
            'admin-menus.edit',
            'admin',
            'admin',
            'admins',
            '\Vegacms\Cms\Http\Controllers\\'
        );

        // Admin menus update
        $this->createRoute('/menus/{menu}/update',
            'patch',
            'MenusController@update',
            'admin-menus.update',
            'admin',
            'admin',
            'admins',
            '\Vegacms\Cms\Http\Controllers\\'
        );

        // Admin menu items create
        $this->createRoute('/menu-items/create',
            'get',
            'MenuItemsController@create',
            'admin-menu-items.create',
            'admin',
            'admin',
            'admins',
            '\Vegacms\Cms\Http\Controllers\\'
        );

        // Admin menu items index
        $this->createRoute('/menu-items/index/{menu}/{menuItem}',
            'get',
            'MenuItemsController@index',
            'admin-menu-items.index',
            'admin',
            'admin',
            'admins',
            '\Vegacms\Cms\Http\Controllers\\'
        );

        // Admin menu items show
        $this->createRoute('/menu-items/{menuItem}',
            'get',
            'MenuItemsController@show',
            'admin-menu-items.show',
            'admin',
            'admin',
            'admins',
            '\Vegacms\Cms\Http\Controllers\\'
        );

        // Admin menu items store
        $this->createRoute('/menu-items/store',
            'post',
            'MenuItemsController@store',
            'admin-menu-items.store',
            'admin',
            'admin',
            'admins',
            '\Vegacms\Cms\Http\Controllers\\'
        );

        // Admin menu items edit
        $this->createRoute('/menu-items/{menuItem}/edit',
            'get',
            'MenuItemsController@edit',
            'admin-menu-items.edit',
            'admin',
            'admin',
            'admins',
            '\Vegacms\Cms\Http\Controllers\\'
        );

        // Admin menu items update
        $this->createRoute('/menu-items/{menuItem}/update',
            'patch',
            'MenuItemsController@update',
            'admin-menu-items.update',
            'admin',
            'admin',
            'admins',
            '\Vegacms\Cms\Http\Controllers\\'
        );

        // Admin pages index
        $this->createRoute('/pages',
            'get',
            'PagesController@index',
            'admin-pages.index',
            'admin',
            'admin',
            'admins',
            '\Vegacms\Cms\Http\Controllers\\'
        );

        // Admin pages create
        $this->createRoute('/pages/create',
            'get',
            'PagesController@create',
            'admin-pages.create',
            'admin',
            'admin',
            'admins',
            '\Vegacms\Cms\Http\Controllers\\'
        );

        // Admin pages show
        $this->createRoute('/pages/{page}',
            'get',
            'PagesController@show',
            'admin-pages.show',
            'admin',
            'admin',
            'admins',
            '\Vegacms\Cms\Http\Controllers\\'
        );

        // Admin pages store
        $this->createRoute('/pages/store',
            'post',
            'PagesController@store',
            'admin-pages.store',
            'admin',
            'admin',
            'admins',
            '\Vegacms\Cms\Http\Controllers\\'
        );

        // Admin pages edit
        $this->createRoute('/pages/{page}/edit',
            'get',
            'PagesController@edit',
            'admin-pages.edit',
            'admin',
            'admin',
            'admins',
            '\Vegacms\Cms\Http\Controllers\\'
        );

        // Admin pages update
        $this->createRoute('/pages/{page}/update',
            'patch',
            'PagesController@update',
            'admin-pages.update',
            'admin',
            'admin',
            'admins',
            '\Vegacms\Cms\Http\Controllers\\'
        );

        // Admin containers index
        $this->createRoute('/containers',
            'get',
            'ContainersController@index',
            'admin-containers.index',
            'admin',
            'admin',
            'admins',
            '\Vegacms\Cms\Http\Controllers\\'
        );

        // Admin containers create
        $this->createRoute('/containers/create',
            'get',
            'ContainersController@create',
            'admin-containers.create',
            'admin',
            'admin',
            'admins',
            '\Vegacms\Cms\Http\Controllers\\'
        );


        // Admin containers show
        $this->createRoute('/containers/{container}',
            'get',
            'ContainersController@show',
            'admin-containers.show',
            'admin',
            'admin',
            'admins',
            '\Vegacms\Cms\Http\Controllers\\'
        );

        // Admin containers store
        $this->createRoute('/containers/store',
            'post',
            'ContainersController@store',
            'admin-containers.store',
            'admin',
            'admin',
            'admins',
            '\Vegacms\Cms\Http\Controllers\\'
        );

        // Admin containers edit
        $this->createRoute('/containers/{container}/edit',
            'get',
            'ContainersController@edit',
            'admin-containers.edit',
            'admin',
            'admin',
            'admins',
            '\Vegacms\Cms\Http\Controllers\\'
        );

        // Admin containers update
        $this->createRoute('/containers/{container}/update',
            'patch',
            'ContainersController@update',
            'admin-containers.update',
            'admin',
            'admin',
            'admins',
            '\Vegacms\Cms\Http\Controllers\\'
        );

        // Admin Models index
        $this->createRoute('/index',
            'get',
            'IndexController@data',
            'admin-models.index',
            'admin',
            'admin',
            'admins',
            '\Vegacms\Cms\Http\Controllers\\'
        );

        // Admin Models destroy
        $this->createRoute('/destroy',
            'delete',
            'DeleteController@destroy',
            'admin-models.destroy',
            'admin',
            'admin',
            'admins',
            '\Vegacms\Cms\Http\Controllers\\'
        );

        // Menu get data
        $this->createRoute('/menu-data',
            'get',
            'MenuController@getData',
            'menus.menu-data',
            'vega-web',
            'front',
            '',
            '\Vegacms\Cms\Http\Controllers\\'
        );

        // Derived Input get data
        $this->createRoute('/derived-input-data',
            'get',
            'DerivedDataController@getModelsData',
            'inputs.derived-input-data',
            'vega-web',
            'front',
            '',
            '\Vegacms\Cms\Http\Controllers\\'
        );

        // Get active locales
        $this->createRoute('/get-active-locales',
            'get',
            'LocalesController@getActiveLocales',
            'locales.get-active-locales',
            'vega-web',
            'front',
            '',
            '\Vegacms\Cms\Http\Controllers\\'
        );

        // Set locale
        $this->createRoute('/set-locale',
            'post',
            'LocalesController@setLocale',
            'locales.set-locale',
            'vega-web',
            'front',
            '',
            '\Vegacms\Cms\Http\Controllers\\'
        );

        // Get locale
        $this->createRoute('/get-locale',
            'get',
            'LocalesController@getLocale',
            'locales.get-locale',
            'vega-web',
            'front',
            '',
            '\Vegacms\Cms\Http\Controllers\\'
        );
    }

    /**
     * Create a route
     *
     * @param string $url
     * @param string $method
     * @param string $action
     * @param string $name
     * @param string $routeType
     * @param string $actionType
     * @param string $groupName
     * @param string $controllerNamespace
     */
    protected function createRoute(string $url,
                                   string $method,
                                   string $action,
                                   string $name,
                                   string $routeType,
                                   string $actionType,
                                   string $groupName = '',
                                   string $controllerNamespace = ''
    ): void {
        if(!Route::where('name', $name)->first()) {
            $routes = $this->routeService->getRoutes();
            if (! $this->routeService->checkForExistingRoute($routes, $name)) {
                $this->routeService->create([
                    'url' => $url,
                    'method' => $method,
                    'action' => $action,
                    'name' => $name,
                    'route_type' => $routeType,
                    'action_type' => $actionType,
                    'controller_namespace' => $controllerNamespace,
                ]);

                if($groupName) {
                    $this->routeService->attachRouteToGroup([
                        'name' => $name,
                        'title' => $groupName,
                    ]);
                }
            } else {
                $route = Route::factory()->create([
                    'url' => $url,
                    'method' => $method,
                    'action' => $action,
                    'name' => $name,
                ]);

                if ($groupName) {
                    Group::where('title', $groupName)->first()->routes()->attach($route->id);
                }
            }
        }
    }
}
