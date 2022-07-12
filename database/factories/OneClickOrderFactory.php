<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class OneClickOrderFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
          'phone' => $this->faker->e164PhoneNumber(),
          'created_at' => $this->faker->dateTimeThisYear(),
          'updated_at' => $this->faker->dateTimeThisYear(),
        ];
    }
}
