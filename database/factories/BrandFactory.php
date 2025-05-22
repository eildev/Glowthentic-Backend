<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class BrandFactory extends Factory
{
    public function definition()
    {
        $name = $this->faker->randomElement([
            'Nike', 'Adidas', 'Zara', 'H&M', 'Levi\'s', 'Gucci', 'Prada', 'Uniqlo', 'Forever 21', 'Ralph Lauren'
        ]);

        return [
            'BrandName' => $name,
            'slug' => Str::slug($name . '-' . $this->faker->unique()->numberBetween(100, 999)),
            'image' => $this->faker->imageUrl(640, 480, 'fashion'),
            // 'description' => $this->faker->paragraph(2),
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
