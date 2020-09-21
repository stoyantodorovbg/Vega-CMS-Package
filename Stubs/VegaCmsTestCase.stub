<?php

namespace Tests;

use Vegacms\Cms\Models\User;
use Vegacms\Cms\Models\Group;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;

abstract class VegaCmsTestCase extends BaseTestCase
{
    use CreatesApplication;

    /**
     * Create an user, authenticate him, assign groups to him
     *
     * @param User|null $user
     * @param string|null $groupName
     * @return User
     */
    protected function authenticate(User $user = null, string $groupName = null) : User
    {
        if (! $user) {
            $user = User::factory()->create();
        }

        if($groupName) {
            $this->assignGroups($user, $groupName);
        }

        $this->actingAs($user);

        return $user;
    }

    /**
     * Assign groups to an user
     *
     * @param User $user
     * @param string $groupName
     */
    protected function assignGroups(User $user, string $groupName): void
    {
        Group::factory()->create([
            'title' => 'admins',
            'description' => 'All rights.',
        ]);
        Group::factory()->create([
            'title' => 'moderators',
            'description' => 'Some back office rights',
        ]);
        Group::factory()->create([
            'title' => 'ordinaryUsers',
            'description' => 'Only front end rights',
        ]);

        switch ($groupName) {
            case 'admins':
                $user->groups()->attach([1, 2, 3]);
                break;
            case 'moderators':
                $user->groups()->attach([2, 3]);
                break;
            case 'ordinaryUsers':
                $user->groups()->attach([3]);
                break;
        }
    }

    /**
     * Get url prefix from config file
     *
     * @return string
     */
    protected function localeUrlPrefix()
    {
        if (config('cms.locales.codes')[0]) {
            return '/' . app()->getLocale();
        }

        return '';
    }
}
