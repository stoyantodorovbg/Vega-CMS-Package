<?php

namespace Vegacms\Cms\Database\Seeders;

use Vegacms\Cms\Models\Locale;
use Illuminate\Database\Seeder;

class LocalesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Locale::factory()->create([
            'language' => 'Bulgarian',
            'status' => 1,
            'code' => 'bg',
        ]);

        Locale::factory()->create([
            'language' => 'English',
            'status' => 1,
            'code' => 'en',
        ]);
    }
}
