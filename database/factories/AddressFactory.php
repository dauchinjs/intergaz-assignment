<?php

namespace Database\Factories;

use App\Models\Client;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Address>
 */
class AddressFactory extends Factory
{
    public function definition()
    {
        return [
            'title' => fake()->streetName(),
            'client_id' => Client::all()->random()->id,
        ];
    }
}
