<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Category;

class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
          'title' => $this->faker->sentence(5),
          'short_description' => $this->faker->paragraph(1),
          'description' => $this->faker->paragraph(3),
          'price' => $this->faker->randomFloat(2, 1000, 5000),
          'old_price' => $this->faker->randomFloat(2, 1000, 5000),
          'category_id' => Category::all()->random(),
          'is_available' => $this->faker->boolean(),
          'is_active' => $this->faker->boolean(),
        ];
    }
}
