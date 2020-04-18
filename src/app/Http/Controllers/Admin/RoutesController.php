<?php

namespace App\Http\Controllers\Admin;

use App\Models\Group;
use App\Models\Route;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\AdminRouteRequest;
use App\Services\Interfaces\RouteServiceInterface;
use App\Http\Requests\Admin\AdminUpdateRouteRequest;

class RoutesController extends Controller
{
    /**
     * @var RouteServiceInterface
     */
    private $routeService;

    /**
     * RoutesController constructor.
     * @param RouteServiceInterface $routeService
     */
    public function __construct(RouteServiceInterface $routeService)
    {
        $this->routeService = $routeService;
    }

    /**
     * Admin routes index page
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        return view('admin.routes.index');
    }

    /**
     * Admin routes show page
     *
     * @param Route $route
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show(Route $route)
    {
        return view('admin.routes.show', compact('route'));
    }

    /**
     * Admin routes create page
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        return view('admin.routes.create');
    }

    /**
     * Admin routes store action
     *
     * @param AdminRouteRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(AdminRouteRequest $request)
    {
        $validationData = $this->routeService->create($request->validated());

        if($validationData === true) {
            $route = Route::where('name', $request->name)->first();

            return redirect()->route('admin-routes.show', $route->getSlug())->with(compact('route'));
        }

        return redirect()->back()->with(['messageData' => $validationData]);
    }

    /**
     * Admin routes edit page
     *
     * @param Route $route
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit(Route $route)
    {
        $groups = Group::where('status', 1)->get();
        $routeGroupsTitles = $route->groups->pluck('title')->toArray();

        return view('admin.routes.edit', compact('route', 'groups', 'routeGroupsTitles'));
    }

    /**
     * Admin routes update action
     *
     * @param Route $route
     * @param AdminRouteRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Route $route, AdminUpdateRouteRequest $request, RouteServiceInterface $routeService)
    {
        $routeGroups = $route->groups->pluck('title')->toArray();
        if($request->titles) {
            foreach ($request->titles as $title) {
                if(!in_array($title, $routeGroups)) {
                    $routeService->attachRouteToGroup([
                        'name' => $route->name,
                        'title' => $title
                    ]);
                }
            }
            foreach ($routeGroups as $group) {
                if(!in_array($group, $request->titles)) {
                    $routeService->detachRouteFromGroup([
                        'name' => $route->name,
                        'title' => $group
                    ]);
                }
            }
        } else {
            foreach ($routeGroups as $group) {
                $routeService->detachRouteFromGroup([
                    'name' => $route->name,
                    'title' => $group
                ]);
            }
        }

        return redirect()->back()->with(compact('route'));
    }
}
