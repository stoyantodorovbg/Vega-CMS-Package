<?php

namespace Tests\Unit;

use Vegacms\Cms\Models\User;
use Vegacms\Cms\Models\Group;
use Tests\VegaCmsTestCase as TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UserTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function the_user_may_has_groups(): void
    {
        $user = User::factory()->create();

        $groups = Group::factory()->count(5)->create();

        $user->groups()->saveMany($groups);

        $this->assertEquals(5, $user->groups->count());
        $this->assertInstanceOf(Group::class, $user->groups[0]);
    }

    /** @test */
    public function the_user_has_an_unique_email(): void
    {
        $user = User::factory()->create();

        $this->expectException('Illuminate\Database\QueryException');

        User::factory()->create([
            'title' => $user->email,
        ]);
    }

    /** @test */
    public function the_user_requires_a_password(): void
    {
        $this->expectException('Illuminate\Database\QueryException');

        User::factory()->create([
            'password' =>null,
        ]);
    }

    /** @test */
    public function the_user_requires_a_email(): void
    {
        $this->expectException('Illuminate\Database\QueryException');

        User::factory()->create([
            'email' =>null,
        ]);
    }

    /** @test */
    public function the_user_requires_a_name(): void
    {
        $this->expectException('Illuminate\Database\QueryException');

        User::factory()->create([
            'name' =>null,
        ]);
    }
}
