<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void {

        $categories = DB::table('categories')->get();

        $sampleProducts = [
            'Cleansers' => [
                'products' => ['Gentle Face Cleanser', 'Deep Cleansing Gel'],
                'variants' => ['100ml', '200ml', '500ml'],
                'unit' => 'ml',
                'regular_price' => 250, // Example price
                'attributes' => [
                    'color' => 'White, Green',
                    'size' => 'Standard',
                    'weight' => '100g, 200g, 500g',
                    'flavor' => 'Aloe Vera'
                ]
            ],
            'Moisturizers' => [
                'products' => ['Hydrating Moisturizer', 'Oil-Free Moisturizer'],
                'variants' => ['50ml', '100ml'],
                'unit' => 'ml',
                'regular_price' => 300,
                'attributes' => [
                    'color' => 'White, Cream',
                    'size' => 'Small, Large',
                    'weight' => '50g, 100g',
                    'flavor' => 'Fragrance-Free'
                ]
            ],
            'Shampoo' => [
                'products' => ['Anti-Dandruff Shampoo', 'Herbal Shampoo'],
                'variants' => ['250ml', '500ml', '1L'],
                'unit' => 'ml',
                'regular_price' => 400,
                'attributes' => [
                    'color' => 'Transparent, Brown',
                    'size' => 'Medium, Large',
                    'weight' => '250g, 500g, 1kg',
                    'flavor' => 'Herbal, Coconut'
                ]
            ],
            'Lipstick' => [
                'products' => ['Matte Red Lipstick', 'Glossy Pink Lipstick'],
                'variants' => ['Matte', 'Glossy'],
                'unit' => 'type',
                'regular_price' => 150,
                'attributes' => [
                    'color' => 'Red, Pink, Nude',
                    'size' => 'Standard',
                    'weight' => '5g',
                    'flavor' => 'Vanilla, Strawberry'
                ]
            ]
        ];




        $products = [];
        $variants = [];
        $brands = DB::table('brands')->pluck('id')->toArray();
        $tagName=DB::table('tag_names')->pluck('id')->toArray();
        foreach ($categories as $category) {
            // Check if the category has a parent (i.e., it's a subcategory)
            $isSubcategory = $category->parent_id !== null;

            foreach ($sampleProducts as $categoryName => $data) {
                if (Str::slug($category->categoryName) === Str::slug($categoryName)) {
                    foreach ($data['products'] as $productName) {
                        $randomBrandId = $brands[array_rand($brands)];
                        $tagNameId = $tagName[array_rand($tagName)];
                        // Insert product
                        $productId = DB::table('products')->insertGetId([
                            'product_name' => $productName,
                            'slug' => Str::slug($productName),
                           'category_id' => $isSubcategory ? $category->parent_id : $category->id,
                            'subcategory_id' => $isSubcategory ? $category->id : null,

                            'brand_id' => $randomBrandId,
                            'unit_id'=>$data['unit'],
                            'sku'=> Str::random(10),
                            'created_by'=>1,
                            'status' => 1,
                            'created_at' => now(),
                            'updated_at' => now()
                        ]);

                        DB::table('product_details')->insert([
                            'product_id' => $productId,
                            'description' => 'A high-quality ' . strtolower($categoryName) . ' product.',
                            'ingredients' => 'Natural ingredients',
                            'usage_instruction' => 'Follow the usage instructions on the product label.',
                            'gender' => 'Unisex',
                            'created_by' => 1,
                            'created_at' => now(),
                            'updated_at' => now()
                        ]);

                        DB::table('product_tags')->insert([
                            'product_id' => $productId,
                            'tag_id' =>  $tagNameId,
                            'created_at' => now(),
                            'updated_at' => now()
                        ]);
                        // Insert variants for this product
                        foreach ($data['variants'] as $variant) {
                            $variantId= DB::table('variants')->insertGetId([
                                'product_id' => $productId,
                                'variant_name' => $variant,
                               'color' => $data['attributes']['color'] ?? null,
                                'size' => $data['attributes']['size'] ?? null,
                                'weight' => $data['attributes']['weight'] ?? null,
                                'flavor' => $data['attributes']['flavor'] ?? null,
                                'regular_price' => $data['regular_price'] ?? null,
                                'created_at' => now(),
                                'updated_at' => now()
                            ]);

                            for ($i = 1; $i <= 3; $i++) { // Assuming 3 images per variant
                                DB::table('variant_image_galleries')->insert([
                                    'product_id' => $productId,
                                    'variant_id' => $variantId, // Corrected this line
                                    'image' => 'uploads/products/variant/' . Str::slug($productName) . '-' . Str::slug($variant) . '-' . $i . '.jpg',
                                    'created_at' => now(),
                                    'updated_at' => now()
                                ]);
                        }
                    }
                }
            }
        }

    }
    }

}
