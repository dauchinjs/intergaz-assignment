<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Route>
 */
class RouteFactory extends Factory
{
    public function definition()
    {
        return [
            'date' => fake()->date(),
            'car_number' => fake()->randomNumber(),
            'status' => fake()->numberBetween(1, 3),
            'driver_name' => fake()->name(),
        ];
    }
}
