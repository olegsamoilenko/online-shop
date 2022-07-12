<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

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
          'name' => $this->faker->firstNameMale(),
          'surname' => $this->faker->lastName(),
          'phone' => $this->faker->e164PhoneNumber(),
          'city' => $this->faker->city(),
          'shipping' => $this->faker->randomElement(['pickupFromTheStore', 'addressDelivery', 'toYourPostOffice']),
          'address' => $this->faker->address(),
          'post_office' => $this->faker->numberBetween(1, 20),
          'payment' => $this->faker->randomElement(['cash', 'card', 'paymentAccount']),
          'order_comment' => $this->faker->text(50),
          'no_confirmation_call' => $this->faker->numberBetween(0, 1),
          'paid' => $this->faker->numberBetween(0, 1),
          'status' => $this->faker->randomElement(['new', 'confirmed', 'rejected', 'WaitingPayment', 'transferredDeliveryService', 'completed']),
          'created_at' => $this->faker->dateTimeThisYear(),
          'updated_at' => $this->faker->dateTimeThisYear(),
        ];
    }
}
