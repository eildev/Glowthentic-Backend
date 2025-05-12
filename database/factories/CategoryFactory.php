<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class CategoryFactory extends Factory
{
    public function definition()
    {
        $name = $this->faker->randomElement(['Men', 'Women', 'Unisex']);

        return [
            'categoryName' => $name,
            'slug' => Str::slug($name . '-' . $this->faker->uuid()),
            'image' => $this->faker->imageUrl(640, 480, 'fashion'),
            'parent_id' => null, // Top-level categories
            'approved_by' => $this->faker->numberBetween(1, 10),
            'status' => 1,
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
