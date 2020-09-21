<?php

namespace Vegacms\Cms\Database\Factories;

use Vegacms\Cms\Models\Route;
use Illuminate\Database\Eloquent\Factories\Factory;

class RouteFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Route::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $uniqueWord = $this->faker->unique()->word;

        return [
            'url' => '/' . $uniqueWord . '/' . $uniqueWord,
            'method' => 'get',
            'action' => 'Front\\' . ucfirst($uniqueWord) . 'Controller@' . $method = $uniqueWord,
            'name' => $uniqueWord . '-' . $uniqueWord . '.' . $method,
            'controller_namespace' => '\Vegacms\Cms\Http\Controllers\\',
        ];
    }
}
