<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class ProductDetailsFactory extends Factory
{
    public function definition()
    {
        return [
            'product_id' => \App\Models\Product::factory(),
            'description' => $this->faker->paragraph(3),
            'ingredients' => $this->faker->randomElement(['100% Cotton', 'Cotton Blend', 'Polyester', 'Denim']),
            'usage_instruction' => $this->faker->sentence(10),
            'gender' => $this->faker->randomElement(['male', 'female', 'unisex']),
            'created_by' => $this->faker->numberBetween(1, 10),
            'short_description' => $this->faker->sentence(5),
            'product_policy' => $this->faker->sentence(8),
            'approved_by' => $this->faker->numberBetween(1, 10),
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
