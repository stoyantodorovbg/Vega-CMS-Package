<?php

namespace Vegacms\Cms\Database\Factories;

use Illuminate\Support\Str;
use Vegacms\Cms\Models\DefaultJsonStructure;
use Illuminate\Database\Eloquent\Factories\Factory;

class DefaultJsonStructureFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = DefaultJsonStructure::class;

    /**
     * Define the model's default state.
     *
     * @return array
     * @throws \JsonException
     */
    public function definition()
    {
        return [
            'model' => Str::studly($this->faker->word . '-' . $this->faker->word),
            'field' => $this->faker->word,
            'structure' => json_encode([
                'text' => 'some text',
                'status' => 1,
                'data' => [
                    'someKey' => 'someValue',
                ]
            ], JSON_THROW_ON_ERROR)
        ];
    }
}
