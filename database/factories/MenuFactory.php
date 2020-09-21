<?php

namespace Vegacms\Cms\Database\Factories;

use Vegacms\Cms\Models\Menu;
use Illuminate\Database\Eloquent\Factories\Factory;

class MenuFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Menu::class;

    /**
     * Define the model's default state.
     *
     * @return array
     * @throws \JsonException
     */
    public function definition()
    {
        return [
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
            'status' => 1,
            'classes' => $this->faker->text(50),
            'styles' => json_encode([
                'height' => '100px',
                'display' => 'inline-block',
                'structure' => []
            ], JSON_THROW_ON_ERROR),
        ];
    }
}

