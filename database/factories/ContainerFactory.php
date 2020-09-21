<?php

namespace Vegacms\Cms\Database\Factories;

use Vegacms\Cms\Models\Container;
use Illuminate\Database\Eloquent\Factories\Factory;

class ContainerFactory extends Factory
{

    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Container::class;

    /**
     * Define the model's default state.
     *
     * @return array
     * @throws \JsonException
     */
    public function definition()
    {
        return [
            'status' => 1,
            'semantic_tag' => 'body',
            'row_position' => 2,
            'col_width' => 8,
            'col_position' => 1,
            'row_classes' => $this->faker->text(50),
            'classes' => $this->faker->text(50),
            'title' => json_encode([
                'text' => $this->faker->word,
                'status' => 1,
                'row_classes' => $this->faker->text(50),
                'classes' => $this->faker->text(50),
                'styles' => [
                    'color' => 'red'
                ],
                'structure' => [
                    'text' => '',
                    'status' => 0,
                    'row_classes' => '',
                    'classes' => '',
                    'styles' => []
                ]
            ], JSON_THROW_ON_ERROR),
            'summary' => json_encode([
                'text' => $this->faker->sentences(2),
                'status' => 1,
                'row_classes' => $this->faker->text(50),
                'classes' => $this->faker->text(50),
                'styles' => [
                    'color' => 'red'
                ],
                'structure' => [
                    'text' => '',
                    'status' => 0,
                    'row_classes' => '',
                    'classes' => '',
                    'styles' => []
                ]
            ], JSON_THROW_ON_ERROR),
            'body' => json_encode([
                'text' => $this->faker->sentences(10),
                'status' => 1,
                'row_classes' => $this->faker->text(50),
                'classes' => $this->faker->text(50),
                'styles' => [
                    'color' => 'red'
                ],
                'structure' => [
                    'text' => '',
                    'status' => 0,
                    'row_classes' => '',
                    'classes' => '',
                    'styles' => []
                ]
            ], JSON_THROW_ON_ERROR),
            'styles' => json_encode([
                'structure' => []
            ], JSON_THROW_ON_ERROR),
        ];
    }
}
