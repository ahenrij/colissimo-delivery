<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class OrderFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'no' => Str::random(10),
            'customer_name' => $this->faker->name,
            'delivery_address' => $this->faker->streetAddress,
            'website' => $this->faker->url,
        ];
    }
}
