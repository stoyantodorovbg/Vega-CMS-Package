<?php

namespace Vegacms\Cms\Repositories;

use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

class LocaleRepository
{
    /**
     * Get the codes for all active application locales
     *
     * @return array
     */
    public function getActiveLocales(): Collection
    {
        return DB::table('locales')->select(['code', 'language'])->where('status', 1)->get();
    }
}
