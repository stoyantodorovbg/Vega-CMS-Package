<?php

namespace Tests\Unit;

use App\Models\User;
use Tests\TestCase;
use App\Models\Group;
use App\Models\Route;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class GroupTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function the_group_may_has_users(): void
    {
        $group = factory(Group::class)->create();

        $users = factory(User::class, 5)->create();

        $group->users()->saveMany($users);

        $this->assertEquals(5, $group->users->count());
        $this->assertInstanceOf(User::class, $group->users[0]);
    }

    /** @test */
    public function the_group_may_has_routes(): void
    {
        $group = factory(Group::class)->create();

        $routes = factory(Route::class, 5)->create();

        $group->routes()->saveMany($routes);

        $this->assertEquals(5, $group->routes->count());
        $this->assertInstanceOf(Route::class, $group->routes[0]);
    }

    /** @test */
    public function the_group_has_an_unique_title(): void
    {
        $group = factory(Group::class)->create();

        $this->expectException('Illuminate\Database\QueryException');

        factory(Group::class)->create([
            'title' => $group->title,
        ]);
    }

    /** @test */
    public function the_group_requires_a_title(): void
    {
        $this->expectException('Illuminate\Database\QueryException');

        factory(User::class)->create([
            'title' =>null,
        ]);
    }
}
