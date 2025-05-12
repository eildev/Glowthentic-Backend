<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;
use App\Models\SubCategory;
use App\Models\Brand;
use App\Models\Product;
use App\Models\ProductDetails;
use App\Models\Variant;
use App\Models\VariantImageGallery;
use Faker\Generator as Faker;

class ProductSeeder extends Seeder
{
    protected $faker;

    public function __construct(Faker $faker)
    {
        $this->faker = $faker;
    }

    public function run()
    {
        // Create Categories
        $menCategory = Category::factory()->create(['categoryName' => 'Men', 'slug' => 'men']);
        $womenCategory = Category::factory()->create(['categoryName' => 'Women', 'slug' => 'women']);
        $unisexCategory = Category::factory()->create(['categoryName' => 'Unisex', 'slug' => 'unisex']);

        // Create SubCategories
        $subCategories = [
            ['subcategoryName' => 'Shirts', 'categoryId' => $menCategory->id],
            ['subcategoryName' => 'T-Shirts', 'categoryId' => $menCategory->id],
            ['subcategoryName' => 'Jeans', 'categoryId' => $menCategory->id],
            ['subcategoryName' => 'Dresses', 'categoryId' => $womenCategory->id],
            ['subcategoryName' => 'Skirts', 'categoryId' => $womenCategory->id],
            ['subcategoryName' => 'Blouses', 'categoryId' => $womenCategory->id],
            ['subcategoryName' => 'Jackets', 'categoryId' => $unisexCategory->id],
            ['subcategoryName' => 'Sweaters', 'categoryId' => $unisexCategory->id],
        ];

        foreach ($subCategories as $subCategory) {
            SubCategory::factory()->create([
                'subcategoryName' => $subCategory['subcategoryName'],
                'slug' => \Illuminate\Support\Str::slug($subCategory['subcategoryName']),
                'categoryId' => $subCategory['categoryId'],
                'image' => $this->faker->imageUrl(640, 480, 'fashion'),
                'status' => 1,
            ]);
        }

        // Create Brands
        $brands = ['Nike', 'Adidas', 'Zara', 'H&M', 'Levi\'s', 'Gucci', 'Prada', 'Uniqlo'];
        foreach ($brands as $brand) {
            Brand::factory()->create([
                'BrandName' => $brand,
                'slug' => \Illuminate\Support\Str::slug($brand),
            ]);
        }

        // Create 10 Men's Products
        Product::factory()
            ->count(10)
            ->state([
                'category_id' => $menCategory->id,
                'subcategory_id' => SubCategory::where('categoryId', $menCategory->id)->inRandomOrder()->first()->id,
            ])
            ->has(ProductDetails::factory()->state(['gender' => 'male']), 'productDetails')
            ->has(
                Variant::factory()
                    ->count(3)
                    ->has(VariantImageGallery::factory()->count(4), 'variantImage'), // Each Variant has 4 images
                'variants'
            )
            ->create();

        // Create 10 Women's Products
        Product::factory()
            ->count(10)
            ->state([
                'category_id' => $womenCategory->id,
                'subcategory_id' => SubCategory::where('categoryId', $womenCategory->id)->inRandomOrder()->first()->id,
            ])
            ->has(ProductDetails::factory()->state(['gender' => 'female']), 'productDetails')
            ->has(
                Variant::factory()
                    ->count(3)
                    ->has(VariantImageGallery::factory()->count(4), 'variantImage'), // Each Variant has 4 images
                'variants'
            )
            ->create();

        // Create 5 Unisex Products
        Product::factory()
            ->count(5)
            ->state([
                'category_id' => $unisexCategory->id,
                'subcategory_id' => SubCategory::where('categoryId', $unisexCategory->id)->inRandomOrder()->first()->id,
            ])
            ->has(ProductDetails::factory()->state(['gender' => 'unisex']), 'productDetails')
            ->has(
                Variant::factory()
                    ->count(3)
                    ->has(VariantImageGallery::factory()->count(4), 'variantImage'), // Each Variant has 4 images
                'variants'
            )
            ->create();
    }
}
