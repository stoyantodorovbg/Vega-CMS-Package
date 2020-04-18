<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\AdminIndexRequest;
use App\Services\Interfaces\EloquentFilterServiceInterface;

class IndexController extends Controller
{
    /**
     * @var EloquentFilterServiceInterface
     */
    protected $eloquentFilterService;

    /**
     * IndexController constructor.
     * @param EloquentFilterServiceInterface $eloquentFilterService
     */
    public function __construct(EloquentFilterServiceInterface $eloquentFilterService)
    {
        $this->eloquentFilterService = $eloquentFilterService;
    }


    /**
     * Return data for admin index pages
     *
     * @param AdminIndexRequest $request
     * @return mixed
     */
    public function data(AdminIndexRequest $request)
    {
        $builder = $this->eloquentFilterService->addFilters($request, "\\App\\Models\\" . $request->model);

        return $builder->paginate($request->items_per_page, ['*'], 'page', $request->page);
    }
}
