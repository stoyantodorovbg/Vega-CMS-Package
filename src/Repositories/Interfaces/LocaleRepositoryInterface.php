<?php

namespace Vegacms\Cms\Repositories\Interfaces;

use Illuminate\Support\Collection;

interface LocaleRepositoryInterface
{
    /**
     * Get the codes for all active application locales
     *
     * @return array
     */
    public function getActiveLocales(): Collection;
}
