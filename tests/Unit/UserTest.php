<?php

namespace Tests\Unit;

use App\Models\User;
use Tests\TestCase;
use App\Models\Group;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UserTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function the_user_may_has_groups(): void
    {
        $user = factory(User::class)->create();

        $groups = factory(Group::class, 5)->create();

        $user->groups()->saveMany($groups);

        $this->assertEquals(5, $user->groups->count());
        $this->assertInstanceOf(Group::class, $user->groups[0]);
    }

    /** @test */
    public function the_user_has_an_unique_email(): void
    {
        $user = factory(User::class)->create();

        $this->expectException('Illuminate\Database\QueryException');

        factory(User::class)->create([
            'title' => $user->email,
        ]);
    }

    /** @test */
    public function the_user_requires_a_password(): void
    {
        $this->expectException('Illuminate\Database\QueryException');

        factory(User::class)->create([
            'password' =>null,
        ]);
    }

    /** @test */
    public function the_user_requires_a_email(): void
    {
        $this->expectException('Illuminate\Database\QueryException');

        factory(User::class)->create([
            'email' =>null,
        ]);
    }

    /** @test */
    public function the_user_requires_a_name(): void
    {
        $this->expectException('Illuminate\Database\QueryException');

        factory(User::class)->create([
            'name' =>null,
        ]);
    }
}
