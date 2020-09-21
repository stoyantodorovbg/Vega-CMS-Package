<?php

namespace Vegacms\Cms\Database\Factories;

use Vegacms\Cms\Models\Menu;
use Vegacms\Cms\Models\MenuItem;
use Illuminate\Database\Eloquent\Factories\Factory;

class MenuItemFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = MenuItem::class;

    /**
     * Define the model's default state.
     *
     * @return array
     * @throws \JsonException
     */
    public function definition()
    {
        return [
            'menu_id' => Menu::factory(),
            'parent_id' => null,
            'status' => 1,
            'url' => $this->faker->url,
            'title' => json_encode([
                'text' => $this->faker->name,
                'status' => 1,
                'classes' => $this->faker->text(50),
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
            'description' => json_encode([
                'text' => $this->faker->text(100),
                'status' => 1,
                'classes' => $this->faker->text(50),
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
            'classes' => $this->faker->text(50),
            'styles' => json_encode([
                'height' => '100px',
                'display' => 'inline-block',
                'structure' => []
            ], JSON_THROW_ON_ERROR),
        ];
    }
}
