<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class VariantFactory extends Factory
{
    public function definition()
    {
        return [
            'product_id' => \App\Models\Product::factory(),
            'variant_name' => $this->faker->word() . ' Variant',
            'color' => $this->faker->safeColorName(),
            'size' => $this->faker->randomElement(['S', 'M', 'L', 'XL', 'XXL']),
            'regular_price' => $this->faker->randomFloat(2, 10, 200),
            'barcode' => $this->faker->ean13,
            'weight' => $this->faker->randomFloat(2, 0.5, 5) . ' kg',
            'flavor' => null, // Not applicable for fashion
            'image' => $this->faker->imageUrl(640, 480, 'fashion'),
            'status' => 'Variant',
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
