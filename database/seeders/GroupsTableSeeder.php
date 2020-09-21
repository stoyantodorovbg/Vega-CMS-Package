<?php

namespace Vegacms\Cms\Database\Seeders;

use Vegacms\Cms\Models\Group;
use Illuminate\Database\Seeder;
use Vegacms\Cms\Services\Interfaces\GroupServiceInterface;
use Vegacms\Cms\Services\Interfaces\FileCreateServiceInterface;

class GroupsTableSeeder extends Seeder
{
    /**
     * @var FileCreateServiceInterface
     */
    protected $fileCreateService;

    /**
     * @var GroupServiceInterface
     */
    private $groupService;

    /**
     * GroupsTableSeeder constructor.
     * @param FileCreateServiceInterface $fileCreateService
     * @param GroupServiceInterface $groupService
     */
    public function __construct(FileCreateServiceInterface $fileCreateService, GroupServiceInterface $groupService)
    {
        $this->fileCreateService = $fileCreateService;
        $this->groupService = $groupService;
    }


    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        // Admins id 1
        if (! $this->middlewareExists('admins')) {
            $this->groupService->create([
                'title' => 'admins',
                'description' => 'All rights.'
            ]);
        } else {
            Group::factory()->create([
                'title' => 'admins',
                'description' => 'All rights.',
            ]);
        }

        // Moderators id 2
        if (! $this->middlewareExists('moderators')) {
            $this->groupService->create([
                'title' => 'moderators',
                'description' => 'Some back office rights.'
            ]);
        } else {
            Group::factory()->create([
                'title' => 'moderators',
                'description' => 'Some back office rights',
            ]);
        }

        // Ordinary users id 3
        if (! $this->middlewareExists('ordinaryUsers')) {
            $this->groupService->create([
                'title' => 'ordinaryUsers',
                'description' => 'Only front end rights.'
            ]);
        } else {
            Group::factory()->create([
                'title' => 'ordinaryUsers',
                'description' => 'Only front end rights',
            ]);
        }
    }

    /**
     * Check if the middleware already exists
     *
     * @param string $groupTitle
     * @return bool
     */
    protected function middlewareExists(string $groupTitle): bool
    {
        return $this->fileCreateService->fileExists(
            '/app/Http/Middleware/',
            ucfirst($groupTitle),
            '.php'
            );
    }
}
