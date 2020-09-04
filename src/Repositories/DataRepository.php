<?php

namespace Vegacms\Cms\Repositories;

use Illuminate\Support\Collection;
use App\Traits\DataRepositoryTrait;
use Illuminate\Database\Eloquent\Builder;
use Vegacms\Cms\Repositories\Interfaces\DataRepositoryInterface;

class DataRepository implements DataRepositoryInterface
{
    use DataRepositoryTrait;

    /**
     * Get derived data from MenuItem collection
     *
     * @param Builder $builder
     * @return Collection
     */
    public function menuItemData(Builder $builder): Collection
    {
        return $builder->get()->map(function ($item) {
            return [
                'value' => $item->id,
                'text' => json_decode($item->title)->text
            ];
        });
    }
}
