<?php

namespace Vegacms\Cms\Repositories\Interfaces;

use Illuminate\Foundation\Auth\User;

interface GroupRepositoryInterface
{
    /**
     * Get the names of all user groups
     *
     * @param User $user
     * @param string $groupTitle
     * @return array
     */
    public function getUserGroupsTitles(User $user, string $groupTitle): array;
}
