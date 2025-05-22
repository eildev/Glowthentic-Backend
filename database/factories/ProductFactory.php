<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\Category;
use App\Models\SubCategory;
use App\Models\Brand;

class ProductFactory extends Factory
{
    public function definition()
    {
        $name = $this->faker->randomElement([
            'Casual Shirt', 'Formal Shirt', 'T-Shirt', 'Jeans', 'Chinos', 'Blazer', 'Dress', 'Skirt', 'Blouse', 'Jacket'
        ]) . ' ' . $this->faker->word();

        return [
            'category_id' => Category::factory(),
            'subcategory_id' => SubCategory::factory(),
            'sub_subcategory_id' => null, // Not provided in schema
            'brand_id' => Brand::factory(),
            'product_feature' => json_encode([
                'material' => $this->faker->randomElement(['Cotton', 'Polyester', 'Wool', 'Denim']),
                'fit' => $this->faker->randomElement(['Slim', 'Regular', 'Loose']),
            ]),
            'product_name' => $name,
            'unit_id' => $this->faker->uuid,
            'slug' => Str::slug($name . '-' . $this->faker->unique()->numberBetween(1000, 9999)),
            'created_by' => $this->faker->numberBetween(1, 10),
            'sku' => $this->faker->unique()->ean13,
            'shipping_charge' => $this->faker->randomElement(['free', 'paid']),
            'status' => 1,
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
