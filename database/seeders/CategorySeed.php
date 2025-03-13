<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class CategorySeed extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            [
                'categoryName' => 'Skincare',
                'children' => [
                    'Cleansers',
                    'Moisturizers',
                    'Serums',
                    'Toners',
                    'Face Masks'
                ]
            ],
            [
                'categoryName' => 'Makeup',
                'children' => [
                    'Foundation',
                    'Lipstick',
                    'Eyeshadow',
                    'Mascara',
                    'Blush'
                ]
            ],
            [
                'categoryName' => 'Haircare',
                'children' => [
                    'Shampoo',
                    'Conditioner',
                    'Hair Masks',
                    'Hair Oils',
                    'Styling Products'
                ]
            ],
            [
                'categoryName' => 'Fragrance',
                'children' => [
                    'Perfume',
                    'Eau de Toilette',
                    'Body Mist',
                    'Cologne',
                    'Scented Oils'
                ]
            ],
            [
                'categoryName' => 'Nail Care',
                'children' => [
                    'Nail Polish',
                    'Base Coat',
                    'Top Coat',
                    'Nail Treatments',
                    'Cuticle Care'
                ]
            ],
            [
                'categoryName' => 'Body Care',
                'children' => [
                    'Body Lotion',
                    'Body Scrubs',
                    'Body Oils',
                    'Shower Gel',
                    'Body Butter'
                ]
            ],
            [
                'categoryName' => 'Sun Care',
                'children' => [
                    'Sunscreen',
                    'After Sun',
                    'Tanning Oil',
                    'SPF Moisturizer',
                    'Sun Spray'
                ]
            ],
            [
                'categoryName' => 'Men\'s Grooming',
                'children' => [
                    'Shaving Cream',
                    'Aftershave',
                    'Beard Oil',
                    'Face Wash',
                    'Hair Gel'
                ]
            ],
            [
                'categoryName' => 'Eye Care',
                'children' => [
                    'Eye Cream',
                    'Eye Serum',
                    'Eye Masks',
                    'Eye Makeup Remover',
                    'Under Eye Patches'
                ]
            ],
            [
                'categoryName' => 'Lip Care',
                'children' => [
                    'Lip Balm',
                    'Lip Scrub',
                    'Lip Mask',
                    'Lip Oil',
                    'Lip Treatment'
                ]
            ],
            [
                'categoryName' => 'Anti-Aging',
                'children' => [
                    'Wrinkle Cream',
                    'Retinol Products',
                    'Night Cream',
                    'Firming Serum',
                    'Collagen Boosters'
                ]
            ],
            [
                'categoryName' => 'Cleansing Tools',
                'children' => [
                    'Face Brushes',
                    'Sponges',
                    'Cleansing Devices',
                    'Konjac Sponges',
                    'Microfiber Cloths'
                ]
            ],
            [
                'categoryName' => 'Bath Products',
                'children' => [
                    'Bath Bombs',
                    'Bubble Bath',
                    'Bath Salts',
                    'Bath Oils',
                    'Bath Fizzers'
                ]
            ],
            [
                'categoryName' => 'Hand Care',
                'children' => [
                    'Hand Cream',
                    'Hand Wash',
                    'Hand Scrub',
                    'Cuticle Cream',
                    'Hand Masks'
                ]
            ],
            [
                'categoryName' => 'Foot Care',
                'children' => [
                    'Foot Cream',
                    'Foot Scrub',
                    'Foot Masks',
                    'Pumice Stones',
                    'Foot Soaks'
                ]
            ],
            [
                'categoryName' => 'Acne Treatment',
                'children' => [
                    'Spot Treatment',
                    'Acne Cleanser',
                    'Acne Masks',
                    'Oil Control',
                    'Pore Strips'
                ]
            ],
            [
                'categoryName' => 'Natural Products',
                'children' => [
                    'Organic Skincare',
                    'Vegan Makeup',
                    'Herbal Haircare',
                    'Natural Oils',
                    'Eco-Friendly Products'
                ]
            ],
            [
                'categoryName' => 'Makeup Tools',
                'children' => [
                    'Brushes',
                    'Sponges',
                    'Applicators',
                    'Brush Cleaners',
                    'Makeup Bags'
                ]
            ],
            [
                'categoryName' => 'Oral Care',
                'children' => [
                    'Toothpaste',
                    'Mouthwash',
                    'Whitening Products',
                    'Lip Scrubs',
                    'Breath Fresheners'
                ]
            ],
            [
                'categoryName' => 'Sensitive Skin',
                'children' => [
                    'Gentle Cleanser',
                    'Hypoallergenic Cream',
                    'Calming Serum',
                    'Non-Irritating Makeup',
                    'Soothing Masks'
                ]
            ]
        ];

        foreach ($categories as $category) {
            // Insert parent category
            $parentId = DB::table('categories')->insertGetId([
                'categoryName' => $category['categoryName'],
                'slug' => Str::slug($category['categoryName']),
                'image' => Str::slug($category['categoryName']) . '.jpg',
                'status' => 1,
                'created_at' => now(),
                'updated_at' => now()
            ]);

            // Insert child categories
            foreach ($category['children'] as $child) {
                DB::table('categories')->insert([
                    'categoryName' => $child,
                    'slug' => Str::slug($child),
                    'image' => Str::slug($child) . '.jpg',
                    'parent_id' => $parentId,
                    'status' => 1,
                    'created_at' => now(),
                    'updated_at' => now()
                ]);
            }
        }
    }
}
