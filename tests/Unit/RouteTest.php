<?php

namespace Tests\Unit;

use Vegacms\Cms\Models\Group;
use Vegacms\Cms\Models\Route;
use Tests\VegaCmsTestCase as TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class RouteTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function the_route_may_has_groups(): void
    {
        $route = Route::factory()->create();

        $groups = Group::factory()->count(5)->create();

        $route->groups()->saveMany($groups);

        $this->assertEquals(5, $route->groups->count());
        $this->assertInstanceOf(Group::class, $route->groups[0]);
    }

    /** @test */
    public function the_route_has_an_unique_action(): void
    {
        $route = Route::factory()->create();

        $this->expectException('Illuminate\Database\QueryException');

        Route::factory()->create([
            'action' => $route->action,
        ]);
    }

    /** @test */
    public function the_route_has_an_unique_name()
    {
        $route = Route::factory()->create();

        $this->expectException('Illuminate\Database\QueryException');

        Route::factory()->create([
            'name' => $route->name,
        ]);
    }
}
