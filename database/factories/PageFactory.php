<?php

namespace Vegacms\Cms\Database\Factories;

use Vegacms\Cms\Models\Page;
use Illuminate\Database\Eloquent\Factories\Factory;

class PageFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Page::class;

    /**
     * Define the model's default state.
     *
     * @return array
     * @throws \JsonException
     */
    public function definition()
    {
        return [
            'url' => '/' . $this->faker->unique()->word,
            'status' => 1,
            'col_width' => 12,
            'title' => $this->faker->word,
            'description' => $this->faker->sentence,
            'outer_row_classes' => $this->faker->text(50),
            'inner_row_classes' => $this->faker->text(50),
            'classes' => $this->faker->text(50),
            'styles' => json_encode([
                'structure' => []
            ], JSON_THROW_ON_ERROR),
            'meta_tags' => json_encode([
                'keywords' => 'example',
                'charset' => 'UTF-8',
            ], JSON_THROW_ON_ERROR),
        ];
    }
}

