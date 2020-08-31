<?php

namespace Vegacms\Cms\Http\Controllers\Front;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Str;
use Illuminate\Support\Collection;
use Vegacms\Cms\Http\Controllers\Controller;
use Vegacms\Cms\Http\Requests\DerivedDataRequest;
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
     * @return \Illuminate\Database\Eloquent\Builder[]|\Illuminate\Database\Eloquent\Collection
     */
    public function getModelsData(DerivedDataRequest $request)
    {
        $modelName = $request->model;

        $builder = $this->eloquentFilterService->addFilters($request, $modelName);

        $modelNameData = explode('\\', $modelName);
        $methodName = Str::camel(end($modelNameData)) . 'Data';

        return [
            'options' => $this->$methodName($builder)
        ];
    }

    /**
     * Get derived data from MenuItem collection
     *
     * @param Builder $builder
     * @return Collection
     */
    protected function menuItemData(Builder $builder): Collection
    {
        return $builder->get()->map(function ($item) {
            return [
                'value' => $item->id,
                'text' => json_decode($item->title)->text
            ];
        });
    }
}
