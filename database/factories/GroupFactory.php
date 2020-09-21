<?php

namespace Vegacms\Cms\Database\Factories;

use Vegacms\Cms\Models\Group;
use Illuminate\Database\Eloquent\Factories\Factory;

class GroupFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Group::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'title' => $this->faker->unique()->word,
            'status' => 1,
            'description' => $this->faker->sentence,
        ];
    }
}
