<?php

namespace Vegacms\Cms\Http\Resources;

use Illuminate\Database\Eloquent\Model;

interface ResourceInterface
{
    /**
     * Return an array of the resource data
     *
     * @return array
     */
    public function toArray(Model $model): array;
}
