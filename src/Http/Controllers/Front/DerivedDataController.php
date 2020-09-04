<?php

namespace Vegacms\Cms\Http\Controllers\Front;

use Illuminate\Support\Str;
use Vegacms\Cms\Http\Controllers\Controller;
use Vegacms\Cms\Http\Requests\DerivedDataRequest;
use Vegacms\Cms\Repositories\Interfaces\DataRepositoryInterface;
use Vegacms\Cms\Services\Interfaces\EloquentFilterServiceInterface;

class DerivedDataController extends Controller
{
    /**
     * @var EloquentFilterServiceInterface
     */
    protected $eloquentFilterService;

    /**
     * IndexController constructor.
     *
     * @param EloquentFilterServiceInterface $eloquentFilterService
     */
    public function __construct(EloquentFilterServiceInterface $eloquentFilterService)
    {
        $this->eloquentFilterService = $eloquentFilterService;
    }

    /**
     * Get models data
     *
     * @param DerivedDataRequest $request
     * @param DataRepositoryInterface $dataRepository
     * @return \Illuminate\Database\Eloquent\Builder[]|\Illuminate\Database\Eloquent\Collection
     */
    public function getModelsData(DerivedDataRequest $request, DataRepositoryInterface $dataRepository)
    {
        $modelName = $request->model;

        $builder = $this->eloquentFilterService->addFilters($request, $modelName);

        $modelNameData = explode('\\', $modelName);
        $methodName = Str::camel(end($modelNameData)) . 'Data';


        return [
            'options' => $dataRepository->$methodName($builder)
        ];
    }
}
