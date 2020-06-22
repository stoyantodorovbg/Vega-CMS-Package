<?php

namespace Vegacms\Cms\Http\Controllers\Admin;

use Vegacms\Cms\Models\Page;
use Vegacms\Cms\Http\Controllers\Controller;
use Vegacms\Cms\DataMappers\DataMapperInterface;
use Vegacms\Cms\Http\Requests\Admin\AdminPageRequest;
use Vegacms\Cms\Repositories\Interfaces\DefaultJsonStructureRepositoryInterface;

class PagesController extends Controller
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
     * Admin pages pages page
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        return view('vegacms::admin.pages.index');
    }

    /**
     * Admin pages show page
     *
     * @param Page $page
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show(Page $page)
    {
        return view('vegacms::admin.pages.show', compact('page'));
    }

    /**
     * Admin pages create page
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create(DefaultJsonStructureRepositoryInterface $defaultJsonStructureRepository)
    {
        $defaultJsonFieldsData = $defaultJsonStructureRepository->getJsonStructureFields(Page::class)
            ->pluck('structure', 'field')->toArray();

        return view('vegacms::admin.pages.create', compact('defaultJsonFieldsData'));
    }

    /**
     * Admin pages store action
     *
     * @param AdminPageRequest $request
     * @param DataMapperInterface $dataMapper
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(AdminPageRequest $request)
    {
        $mappedData = $this->dataMapper->mapData($request->validated());

        $page = Page::create($mappedData);

        return redirect()->route('admin-pages.show', $page->getSlug())->with(compact('page'));
    }

    /**
     * Admin pages edit page
     *
     * @param Page $page
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit(Page $page)
    {
        $page->getData();

        return view('vegacms::admin.pages.edit', compact('page'));
    }

    /**
     * Admin pages update action
     *
     * @param Page $page
     * @param AdminPageRequest $request
     * @param DataMapperInterface $dataMapper
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Page $page, AdminPageRequest $request)
    {
        $mappedData = $this->dataMapper->mapData($request->validated());

        $page->update($mappedData);

        return redirect()->back()->with(compact('page'));
    }
}
