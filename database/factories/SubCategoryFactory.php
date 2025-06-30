<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\Category;

class SubCategoryFactory extends Factory
{
    public function definition()
    {
        $name = $this->faker->randomElement([
            'Shirts', 'T-Shirts', 'Jeans', 'Dresses', 'Skirts', 'Blouses', 'Jackets', 'Trousers', 'Sweaters', 'Shorts'
        ]);

        return [
            'categoryId' => Category::factory(),
            'subcategoryName' => $name,
            'slug' => Str::slug($name . '-' . $this->faker->uuid()),
            'image' => $this->faker->imageUrl(640, 480, 'fashion'),
            'status' => 1,
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
