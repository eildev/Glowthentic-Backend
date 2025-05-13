<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class ProductGalleryFactory extends Factory
{
    public function definition()
    {
        return [
            'product_id' => \App\Models\Product::factory(),
            'image' => $this->faker->imageUrl(640, 480, 'fashion'),
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
