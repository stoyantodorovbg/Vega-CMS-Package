<?php

namespace Vegacms\Cms\Database\Seeders;

use Vegacms\Cms\Models\Container;
use Illuminate\Database\Seeder;

class ContainersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Container::factory()->create([
            'status' => 1,
            'semantic_tag' => 'body',
            'row_position' => 2,
            'col_width' => 8,
            'col_position' => 1,
            'classes' => '',
            'title' => json_encode([
                'text' => 'Test Body Title',
                'status' => 1,
                'classes' => '',
                'styles' => [
                    'color' => 'red'
                ],
                'structure' => [
                    'text' => '',
                    'status' => 0,
                    'classes' => '',
                    'styles' => []
                ]
            ], JSON_THROW_ON_ERROR),
            'summary' => json_encode([
                'text' => 'Test Body Summary',
                'status' => 1,
                'classes' => '',
                'styles' => [
                    'color' => 'red'
                ],
                'structure' => [
                    'text' => '',
                    'status' => 0,
                    'classes' => '',
                    'styles' => []
                ]
            ], JSON_THROW_ON_ERROR),
            'body' => json_encode([
                'text' => 'Test Body Body',
                'status' => 1,
                'classes' => '',
                'styles' => [
                    'color' => 'red'
                ],
                'structure' => [
                    'text' => '',
                    'status' => 0,
                    'classes' => '',
                    'styles' => []
                ]
            ], JSON_THROW_ON_ERROR),
            'styles' => json_encode([
                'structure' => []
            ], JSON_THROW_ON_ERROR),
        ]);
    }
}
