<?php

namespace Vegacms\Cms\Database\Factories;

use Vegacms\Cms\Models\Phrase;
use Illuminate\Database\Eloquent\Factories\Factory;

class PhraseFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Phrase::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'system_name' => $this->faker->unique()->word,
            'text' => [
                'en' => $this->faker->word,
                'bg' => $this->faker->word,
                'structure' => [
                    'en' => '',
                    'bg' => ''
                ]
            ],
        ];
    }
}

