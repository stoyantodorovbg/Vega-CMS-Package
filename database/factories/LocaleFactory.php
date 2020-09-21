<?php

namespace Vegacms\Cms\Database\Factories;

use Vegacms\Cms\Models\Locale;
use Illuminate\Database\Eloquent\Factories\Factory;

class LocaleFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Locale::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'language' => $this->faker->unique()->word,
            'code' => $this->faker->unique()->locale,
            'status' => 1,
            'add_to_url' => 1,
        ];
    }
}

