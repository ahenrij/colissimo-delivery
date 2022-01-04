<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class ItemFactory extends Factory
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
            'title' => $this->faker->jobTitle,
            'quantity' => random_int(1, 5),
        ];
    }
}
