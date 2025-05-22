<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Variant;
use App\Models\Product;
use Illuminate\Support\Facades\Storage;

class VariantImageGalleryFactory extends Factory
{
    public function definition()
    {
        // List of sample images
        $sampleImages = [
            'sample1.jpg',
            'sample2.jpg',
            'sample3.jpg',
        ];

        // Generate a unique file name
        $fileName = 'variant-' . $this->faker->unique()->numberBetween(1000, 9999) . '.jpg';

        // Select a random sample image
        $sampleImage = $this->faker->randomElement($sampleImages);

        // Copy the sample image to the target directory
        $samplePath = storage_path('app/public/images/sample/' . $sampleImage);
        $targetPath = 'uploads/fake/products/' . $fileName;
        Storage::disk('public')->put($targetPath, file_get_contents($samplePath));

        return [
            'variant_id' => Variant::factory(),
            'product_id' => Product::factory(),
            'image' => $targetPath,
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
