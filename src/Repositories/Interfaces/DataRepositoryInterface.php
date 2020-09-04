<?php

namespace Vegacms\Cms\Repositories\Interfaces;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Collection;

interface DataRepositoryInterface
{
    /**
     * Get derived data from MenuItem collection
     *
     * @param Builder $builder
     * @return Collection
     */
    public function menuItemData(Builder $builder): Collection;
}
