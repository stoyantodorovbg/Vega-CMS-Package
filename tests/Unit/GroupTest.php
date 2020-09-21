<?php

namespace Tests\Unit;

use Vegacms\Cms\Models\User;
use Vegacms\Cms\Models\Group;
use Vegacms\Cms\Models\Route;
use Tests\VegaCmsTestCase as TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class GroupTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function the_group_may_has_users(): void
    {
        $group = Group::factory()->create();

        $users = User::factory()->count(5)->create();

        $group->users()->saveMany($users);

        $this->assertEquals(5, $group->users->count());
        $this->assertInstanceOf(User::class, $group->users[0]);
    }

    /** @test */
    public function the_group_may_has_routes(): void
    {
        $group = Group::factory()->create();

        $routes = Route::factory()->count(5)->create();

        $group->routes()->saveMany($routes);

        $this->assertEquals(5, $group->routes->count());
        $this->assertInstanceOf(Route::class, $group->routes[0]);
    }

    /** @test */
    public function the_group_has_an_unique_title(): void
    {
        $group = Group::factory()->create();

        $this->expectException('Illuminate\Database\QueryException');

        Group::factory()->create([
            'title' => $group->title,
        ]);
    }

    /** @test */
    public function the_group_requires_a_title(): void
    {
        $this->expectException('Illuminate\Database\QueryException');

        User::factory()->create([
            'title' =>null,
        ]);
    }
}
