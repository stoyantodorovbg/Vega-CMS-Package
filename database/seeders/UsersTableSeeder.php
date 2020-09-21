<?php

namespace Vegacms\Cms\Database\Seeders;

use Vegacms\Cms\Models\User;
use Vegacms\Cms\Models\Group;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        //$groups = Group::all();

        //Admin id 1
        $admin = User::factory()->create([
            'name' => 'Admin',
            'email' => 'admin@example.com',
            'password' => bcrypt('secret'),
        ]);
        $admin->groups()->attach([1, 2, 3]);
        //$groups->pull(0);

        //Moderator id 2
        $moderator = User::factory()->create([
            'name' => 'Moderator',
            'email' => 'moderator@example.com',
            'password' => bcrypt('secret'),
        ]);
        $moderator->groups()->attach([2, 3]);
        //$groups->pull(1);

        //User id 3
        $user = User::factory()->create([
            'name' => 'User',
            'email' => 'user@example.com',
            'password' => bcrypt('secret'),
        ]);
        $user->groups()->attach([3]);
    }
}
