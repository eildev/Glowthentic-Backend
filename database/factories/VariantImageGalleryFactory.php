<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Variant;
use App\Models\Product;

class VariantImageGalleryFactory extends Factory
{
    public function definition()
    {
        return [
            'variant_id' => Variant::factory(),
            'product_id' => Product::factory(),
            'image' => $this->faker->imageUrl(640, 480, 'fashion'),
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
