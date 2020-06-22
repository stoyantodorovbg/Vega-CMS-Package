<?php

namespace Vegacms\Cms\Repositories;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Collection;
use Vegacms\Cms\Models\DefaultJsonStructure;
use Vegacms\Cms\Repositories\Interfaces\DefaultJsonStructureRepositoryInterface;

class DefaultJsonStructureRepository implements DefaultJsonStructureRepositoryInterface
{
    /**
     * Retrieves defaut fields structure data for a JSON model fields
     *
     * @param string $model
     * @return Collection
     */
    public function getJsonStructureFields(string $model): Collection
    {
        return DB::table('default_json_structures')
            ->select('field', 'structure')
            ->where('model', $model)
            ->get();
    }
}
