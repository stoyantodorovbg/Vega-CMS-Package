<?php

namespace Vegacms\Cms\Http\Controllers\Admin;

use Vegacms\Cms\Models\Menu;
use Vegacms\Cms\Http\Controllers\Controller;
use Vegacms\Cms\DataMappers\DataMapperInterface;
use Vegacms\Cms\Http\Requests\Admin\AdminMenuRequest;
use Vegacms\Cms\Repositories\Interfaces\DefaultJsonStructureRepositoryInterface;

class MenusController extends Controller
{
    /**
     * @var DataMapperInterface
     */
    protected $dataMapper;

    /**
     * PagesController constructor.
     * @param DataMapperInterface $dataMapper
     */
    public function __construct(DataMapperInterface $dataMapper)
    {
        $this->dataMapper = $dataMapper;
    }

    /**
     * Admin menus menus page
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        return view('vegacms::admin.menus.index');
    }

    /**
     * Admin menus show page
     *
     * @param Menu $menu
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show(Menu $menu)
    {
        return view('vegacms::admin.menus.show', compact('menu'));
    }

    /**
     * Admin menus create page
     *
     * @param DefaultJsonStructureRepositoryInterface $defaultJsonStructureRepository
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create(DefaultJsonStructureRepositoryInterface $defaultJsonStructureRepository)
    {
        $defaultJsonFieldsData = $defaultJsonStructureRepository->getJsonStructureFields(Menu::class)
            ->pluck('structure', 'field')->toArray();

        return view('vegacms::admin.menus.create', compact('defaultJsonFieldsData'));
    }

    /**
     * Admin menus store action
     *
     * @param AdminMenuRequest $request
     * @param DataMapperInterface $dataMapper
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(AdminMenuRequest $request)
    {
        $mappedData = $this->dataMapper->mapData($request->validated());

        $menu = Menu::create($mappedData);

        return redirect()->route('admin-menus.show', $menu->getSlug())->with(compact('menu'));
    }

    /**
     * Admin menus edit page
     *
     * @param Menu $menu
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit(Menu $menu)
    {
        $menu->loadAllMenuItems();

        return view('vegacms::admin.menus.edit', compact('menu'));
    }

    /**
     * Admin menus update action
     *
     * @param Menu $menu
     * @param AdminMenuRequest $request
     * @param DataMapperInterface $dataMapper
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Menu $menu, AdminMenuRequest $request)
    {
        $mappedData = $this->dataMapper->mapData($request->validated());

        $menu->update($mappedData);

        return redirect()->back()->with(compact('menu'));
    }
}
