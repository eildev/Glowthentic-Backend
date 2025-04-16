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
    public function run(): void
    {
        $categories = DB::table('categories')->get();
        $brands = DB::table('brands')->pluck('id')->toArray();
        $tagNames = DB::table('tag_names')->pluck('id')->toArray();

        // Define sample products for each subcategory with at least 5 products and max 5 variants
        $sampleProducts = [
            // Skincare
            'Cleansers' => [
                'products' => [
                    ['name' => 'Gentle Face Cleanser', 'variants' => ['100ml', '200ml', '300ml'], 'unit' => 'ml', 'regular_price' => 250],
                    ['name' => 'Deep Cleansing Gel', 'variants' => ['150ml', '250ml', '400ml'], 'unit' => 'ml', 'regular_price' => 300],
                    ['name' => 'Foaming Cleanser', 'variants' => ['100ml', '200ml'], 'unit' => 'ml', 'regular_price' => 200],
                    ['name' => 'Micellar Water', 'variants' => ['200ml', '400ml', '600ml'], 'unit' => 'ml', 'regular_price' => 350],
                    ['name' => 'Oil-Based Cleanser', 'variants' => ['100ml', '300ml', '500ml'], 'unit' => 'ml', 'regular_price' => 400],
                ],
                'attributes' => [
                    'color' => 'White, Green',
                    'size' => 'Standard',
                    'weight' => '100g, 200g, 500g',
                    'flavor' => 'Aloe Vera, Lavender'
                ]
            ],
            'Moisturizers' => [
                'products' => [
                    ['name' => 'Hydrating Moisturizer', 'variants' => ['50ml', '100ml', '150ml'], 'unit' => 'ml', 'regular_price' => 300],
                    ['name' => 'Oil-Free Moisturizer', 'variants' => ['50ml', '100ml'], 'unit' => 'ml', 'regular_price' => 280],
                    ['name' => 'Night Cream', 'variants' => ['30ml', '60ml', '100ml'], 'unit' => 'ml', 'regular_price' => 450],
                    ['name' => 'Day Cream SPF', 'variants' => ['50ml', '75ml', '100ml'], 'unit' => 'ml', 'regular_price' => 500],
                    ['name' => 'Anti-Aging Moisturizer', 'variants' => ['50ml', '100ml', '200ml'], 'unit' => 'ml', 'regular_price' => 600],
                ],
                'attributes' => [
                    'color' => 'White, Cream',
                    'size' => 'Small, Large',
                    'weight' => '50g, 100g',
                    'flavor' => 'Fragrance-Free, Rose'
                ]
            ],
            'Serums' => [
                'products' => [
                    ['name' => 'Vitamin C Serum', 'variants' => ['20ml', '30ml', '50ml'], 'unit' => 'ml', 'regular_price' => 700],
                    ['name' => 'Hyaluronic Acid Serum', 'variants' => ['30ml', '50ml'], 'unit' => 'ml', 'regular_price' => 650],
                    ['name' => 'Retinol Serum', 'variants' => ['25ml', '50ml', '75ml'], 'unit' => 'ml', 'regular_price' => 800],
                    ['name' => 'Niacinamide Serum', 'variants' => ['30ml', '60ml'], 'unit' => 'ml', 'regular_price' => 600],
                    ['name' => 'Brightening Serum', 'variants' => ['20ml', '40ml', '60ml'], 'unit' => 'ml', 'regular_price' => 750],
                ],
                'attributes' => [
                    'color' => 'Clear, Yellow',
                    'size' => 'Small, Medium',
                    'weight' => '20g, 50g',
                    'flavor' => 'Unscented'
                ]
            ],
            'Toners' => [
                'products' => [
                    ['name' => 'Rose Water Toner', 'variants' => ['100ml', '200ml'], 'unit' => 'ml', 'regular_price' => 200],
                    ['name' => 'Hydrating Toner', 'variants' => ['150ml', '250ml', '350ml'], 'unit' => 'ml', 'regular_price' => 250],
                    ['name' => 'Exfoliating Toner', 'variants' => ['100ml', '200ml'], 'unit' => 'ml', 'regular_price' => 300],
                    ['name' => 'Pore Tightening Toner', 'variants' => ['120ml', '240ml', '360ml'], 'unit' => 'ml', 'regular_price' => 350],
                    ['name' => 'Calming Toner', 'variants' => ['100ml', '200ml', '300ml'], 'unit' => 'ml', 'regular_price' => 280],
                ],
                'attributes' => [
                    'color' => 'Clear, Pink',
                    'size' => 'Standard',
                    'weight' => '100g, 200g',
                    'flavor' => 'Rose, Chamomile'
                ]
            ],
            'Face Masks' => [
                'products' => [
                    ['name' => 'Clay Mask', 'variants' => ['50g', '100g', '150g'], 'unit' => 'g', 'regular_price' => 400],
                    ['name' => 'Sheet Mask Pack', 'variants' => ['5pcs', '10pcs'], 'unit' => 'pcs', 'regular_price' => 300],
                    ['name' => 'Hydrating Mask', 'variants' => ['50g', '100g'], 'unit' => 'g', 'regular_price' => 350],
                    ['name' => 'Charcoal Mask', 'variants' => ['75g', '150g', '200g'], 'unit' => 'g', 'regular_price' => 450],
                    ['name' => 'Peel-Off Mask', 'variants' => ['60g', '120g', '180g'], 'unit' => 'g', 'regular_price' => 500],
                ],
                'attributes' => [
                    'color' => 'Green, Black',
                    'size' => 'Medium, Large',
                    'weight' => '50g, 100g',
                    'flavor' => 'Mint, Unscented'
                ]
            ],

            // Makeup
            'Foundation' => [
                'products' => [
                    ['name' => 'Matte Foundation', 'variants' => ['Light', 'Medium', 'Dark'], 'unit' => 'shade', 'regular_price' => 600],
                    ['name' => 'Liquid Foundation', 'variants' => ['Ivory', 'Beige', 'Tan', 'Dark'], 'unit' => 'shade', 'regular_price' => 650],
                    ['name' => 'Cushion Foundation', 'variants' => ['Fair', 'Natural'], 'unit' => 'shade', 'regular_price' => 700],
                    ['name' => 'Powder Foundation', 'variants' => ['Light', 'Medium', 'Tan'], 'unit' => 'shade', 'regular_price' => 550],
                    ['name' => 'BB Cream', 'variants' => ['Light', 'Medium', 'Dark'], 'unit' => 'shade', 'regular_price' => 500],
                ],
                'attributes' => [
                    'color' => 'Various Shades',
                    'size' => 'Standard',
                    'weight' => '30g',
                    'flavor' => 'Unscented'
                ]
            ],
            'Lipstick' => [
                'products' => [
                    ['name' => 'Matte Red Lipstick', 'variants' => ['Matte', 'Satin'], 'unit' => 'type', 'regular_price' => 150],
                    ['name' => 'Glossy Pink Lipstick', 'variants' => ['Glossy', 'Sheer'], 'unit' => 'type', 'regular_price' => 180],
                    ['name' => 'Nude Lipstick', 'variants' => ['Matte', 'Cream', 'Glossy'], 'unit' => 'type', 'regular_price' => 200],
                    ['name' => 'Bold Coral Lipstick', 'variants' => ['Matte', 'Satin'], 'unit' => 'type', 'regular_price' => 170],
                    ['name' => 'Plum Lipstick', 'variants' => ['Matte', 'Glossy', 'Sheer'], 'unit' => 'type', 'regular_price' => 190],
                ],
                'attributes' => [
                    'color' => 'Red, Pink, Nude',
                    'size' => 'Standard',
                    'weight' => '5g',
                    'flavor' => 'Vanilla, Strawberry'
                ]
            ],
            'Eyeshadow' => [
                'products' => [
                    ['name' => 'Neutral Palette', 'variants' => ['Matte', 'Shimmer'], 'unit' => 'type', 'regular_price' => 400],
                    ['name' => 'Smokey Palette', 'variants' => ['Matte', 'Glitter'], 'unit' => 'type', 'regular_price' => 450],
                    ['name' => 'Bright Palette', 'variants' => ['Matte', 'Satin', 'Shimmer'], 'unit' => 'type', 'regular_price' => 500],
                    ['name' => 'Single Eyeshadow', 'variants' => ['Gold', 'Silver', 'Bronze'], 'unit' => 'shade', 'regular_price' => 150],
                    ['name' => 'Pastel Palette', 'variants' => ['Matte', 'Shimmer'], 'unit' => 'type', 'regular_price' => 420],
                ],
                'attributes' => [
                    'color' => 'Various Shades',
                    'size' => 'Small, Large',
                    'weight' => '10g',
                    'flavor' => 'Unscented'
                ]
            ],
            'Mascara' => [
                'products' => [
                    ['name' => 'Volumizing Mascara', 'variants' => ['Black', 'Brown'], 'unit' => 'shade', 'regular_price' => 250],
                    ['name' => 'Lengthening Mascara', 'variants' => ['Black', 'Blue'], 'unit' => 'shade', 'regular_price' => 280],
                    ['name' => 'Waterproof Mascara', 'variants' => ['Black', 'Brown'], 'unit' => 'shade', 'regular_price' => 300],
                    ['name' => 'Curling Mascara', 'variants' => ['Black'], 'unit' => 'shade', 'regular_price' => 270],
                    ['name' => 'Fiber Mascara', 'variants' => ['Black', 'Brown'], 'unit' => 'shade', 'regular_price' => 320],
                ],
                'attributes' => [
                    'color' => 'Black, Brown',
                    'size' => 'Standard',
                    'weight' => '10g',
                    'flavor' => 'Unscented'
                ]
            ],
            'Blush' => [
                'products' => [
                    ['name' => 'Pink Blush', 'variants' => ['Powder', 'Cream'], 'unit' => 'type', 'regular_price' => 200],
                    ['name' => 'Peach Blush', 'variants' => ['Powder', 'Cream'], 'unit' => 'type', 'regular_price' => 220],
                    ['name' => 'Rose Blush', 'variants' => ['Powder'], 'unit' => 'type', 'regular_price' => 190],
                    ['name' => 'Coral Blush', 'variants' => ['Powder', 'Cream'], 'unit' => 'type', 'regular_price' => 210],
                    ['name' => 'Bronze Blush', 'variants' => ['Powder', 'Cream'], 'unit' => 'type', 'regular_price' => 230],
                ],
                'attributes' => [
                    'color' => 'Pink, Peach',
                    'size' => 'Standard',
                    'weight' => '8g',
                    'flavor' => 'Unscented'
                ]
            ],

            // Haircare
            'Shampoo' => [
                'products' => [
                    ['name' => 'Anti-Dandruff Shampoo', 'variants' => ['250ml', '500ml'], 'unit' => 'ml', 'regular_price' => 400],
                    ['name' => 'Herbal Shampoo', 'variants' => ['200ml', '400ml', '600ml'], 'unit' => 'ml', 'regular_price' => 350],
                    ['name' => 'Volumizing Shampoo', 'variants' => ['300ml', '500ml'], 'unit' => 'ml', 'regular_price' => 380],
                    ['name' => 'Moisturizing Shampoo', 'variants' => ['250ml', '500ml', '750ml'], 'unit' => 'ml', 'regular_price' => 420],
                    ['name' => 'Color-Protect Shampoo', 'variants' => ['200ml', '400ml'], 'unit' => 'ml', 'regular_price' => 390],
                ],
                'attributes' => [
                    'color' => 'Transparent, Brown',
                    'size' => 'Medium, Large',
                    'weight' => '250g, 500g',
                    'flavor' => 'Herbal, Coconut'
                ]
            ],
            'Conditioner' => [
                'products' => [
                    ['name' => 'Hydrating Conditioner', 'variants' => ['200ml', '400ml'], 'unit' => 'ml', 'regular_price' => 350],
                    ['name' => 'Repair Conditioner', 'variants' => ['250ml', '500ml'], 'unit' => 'ml', 'regular_price' => 400],
                    ['name' => 'Smooth Conditioner', 'variants' => ['300ml', '600ml'], 'unit' => 'ml', 'regular_price' => 380],
                    ['name' => 'Color-Safe Conditioner', 'variants' => ['200ml', '400ml'], 'unit' => 'ml', 'regular_price' => 370],
                    ['name' => 'Volumizing Conditioner', 'variants' => ['250ml', '500ml'], 'unit' => 'ml', 'regular_price' => 390],
                ],
                'attributes' => [
                    'color' => 'White, Cream',
                    'size' => 'Medium, Large',
                    'weight' => '200g, 400g',
                    'flavor' => 'Coconut, Vanilla'
                ]
            ],
            'Hair Masks' => [
                'products' => [
                    ['name' => 'Deep Repair Hair Mask', 'variants' => ['100g', '200g'], 'unit' => 'g', 'regular_price' => 500],
                    ['name' => 'Hydrating Hair Mask', 'variants' => ['150g', '300g'], 'unit' => 'g', 'regular_price' => 450],
                    ['name' => 'Keratin Hair Mask', 'variants' => ['100g', '250g'], 'unit' => 'g', 'regular_price' => 480],
                    ['name' => 'Argan Oil Hair Mask', 'variants' => ['200g', '400g'], 'unit' => 'g', 'regular_price' => 520],
                    ['name' => 'Color Revive Hair Mask', 'variants' => ['150g', '300g'], 'unit' => 'g', 'regular_price' => 470],
                ],
                'attributes' => [
                    'color' => 'Cream, Brown',
                    'size' => 'Small, Large',
                    'weight' => '100g, 200g',
                    'flavor' => 'Argan, Unscented'
                ]
            ],
            'Hair Oils' => [
                'products' => [
                    ['name' => 'Argan Hair Oil', 'variants' => ['50ml', '100ml'], 'unit' => 'ml', 'regular_price' => 300],
                    ['name' => 'Coconut Hair Oil', 'variants' => ['60ml', '120ml'], 'unit' => 'ml', 'regular_price' => 250],
                    ['name' => 'Jojoba Hair Oil', 'variants' => ['50ml', '100ml'], 'unit' => 'ml', 'regular_price' => 280],
                    ['name' => 'Castor Hair Oil', 'variants' => ['75ml', '150ml'], 'unit' => 'ml', 'regular_price' => 320],
                    ['name' => 'Almond Hair Oil', 'variants' => ['50ml', '100ml'], 'unit' => 'ml', 'regular_price' => 270],
                ],
                'attributes' => [
                    'color' => 'Clear, Golden',
                    'size' => 'Small, Medium',
                    'weight' => '50g, 100g',
                    'flavor' => 'Natural, Coconut'
                ]
            ],
            'Styling Products' => [
                'products' => [
                    ['name' => 'Hair Gel', 'variants' => ['100g', '200g'], 'unit' => 'g', 'regular_price' => 200],
                    ['name' => 'Hair Spray', 'variants' => ['150ml', '300ml'], 'unit' => 'ml', 'regular_price' => 250],
                    ['name' => 'Mousse', 'variants' => ['200ml', '400ml'], 'unit' => 'ml', 'regular_price' => 280],
                    ['name' => 'Wax', 'variants' => ['50g', '100g'], 'unit' => 'g', 'regular_price' => 220],
                    ['name' => 'Pomade', 'variants' => ['75g', '150g'], 'unit' => 'g', 'regular_price' => 240],
                ],
                'attributes' => [
                    'color' => 'Clear, White',
                    'size' => 'Small, Large',
                    'weight' => '100g, 200g',
                    'flavor' => 'Unscented'
                ]
            ],

            // Fragrance
            'Perfume' => [
                'products' => [
                    ['name' => 'Floral Perfume', 'variants' => ['30ml', '50ml', '100ml'], 'unit' => 'ml', 'regular_price' => 1000],
                    ['name' => 'Woody Perfume', 'variants' => ['50ml', '100ml'], 'unit' => 'ml', 'regular_price' => 1200],
                    ['name' => 'Citrus Perfume', 'variants' => ['30ml', '75ml'], 'unit' => 'ml', 'regular_price' => 900],
                    ['name' => 'Oriental Perfume', 'variants' => ['50ml', '100ml'], 'unit' => 'ml', 'regular_price' => 1100],
                    ['name' => 'Fresh Perfume', 'variants' => ['30ml', '50ml', '100ml'], 'unit' => 'ml', 'regular_price' => 950],
                ],
                'attributes' => [
                    'color' => 'Clear',
                    'size' => 'Small, Large',
                    'weight' => '30g, 100g',
                    'flavor' => 'Floral, Woody'
                ]
            ],
            'Eau de Toilette' => [
                'products' => [
                    ['name' => 'Light EDT', 'variants' => ['50ml', '100ml'], 'unit' => 'ml', 'regular_price' => 800],
                    ['name' => 'Spicy EDT', 'variants' => ['30ml', '75ml'], 'unit' => 'ml', 'regular_price' => 850],
                    ['name' => 'Fruity EDT', 'variants' => ['50ml', '100ml'], 'unit' => 'ml', 'regular_price' => 820],
                    ['name' => 'Aqua EDT', 'variants' => ['30ml', '50ml'], 'unit' => 'ml', 'regular_price' => 780],
                    ['name' => 'Green EDT', 'variants' => ['50ml', '100ml'], 'unit' => 'ml', 'regular_price' => 830],
                ],
                'attributes' => [
                    'color' => 'Clear',
                    'size' => 'Small, Medium',
                    'weight' => '50g, 100g',
                    'flavor' => 'Fruity, Spicy'
                ]
            ],
            'Body Mist' => [
                'products' => [
                    ['name' => 'Vanilla Body Mist', 'variants' => ['100ml', '200ml'], 'unit' => 'ml', 'regular_price' => 300],
                    ['name' => 'Floral Body Mist', 'variants' => ['150ml', '250ml'], 'unit' => 'ml', 'regular_price' => 320],
                    ['name' => 'Citrus Body Mist', 'variants' => ['100ml', '200ml'], 'unit' => 'ml', 'regular_price' => 280],
                    ['name' => 'Berry Body Mist', 'variants' => ['150ml', '300ml'], 'unit' => 'ml', 'regular_price' => 310],
                    ['name' => 'Ocean Body Mist', 'variants' => ['100ml', '200ml'], 'unit' => 'ml', 'regular_price' => 290],
                ],
                'attributes' => [
                    'color' => 'Clear',
                    'size' => 'Medium, Large',
                    'weight' => '100g, 200g',
                    'flavor' => 'Vanilla, Berry'
                ]
            ],
            'Cologne' => [
                'products' => [
                    ['name' => 'Classic Cologne', 'variants' => ['50ml', '100ml'], 'unit' => 'ml', 'regular_price' => 700],
                    ['name' => 'Woody Cologne', 'variants' => ['30ml', '75ml'], 'unit' => 'ml', 'regular_price' => 750],
                    ['name' => 'Fresh Cologne', 'variants' => ['50ml', '100ml'], 'unit' => 'ml', 'regular_price' => 720],
                    ['name' => 'Spicy Cologne', 'variants' => ['30ml', '50ml'], 'unit' => 'ml', 'regular_price' => 680],
                    ['name' => 'Citrus Cologne', 'variants' => ['50ml', '100ml'], 'unit' => 'ml', 'regular_price' => 710],
                ],
                'attributes' => [
                    'color' => 'Clear',
                    'size' => 'Small, Medium',
                    'weight' => '50g, 100g',
                    'flavor' => 'Woody, Citrus'
                ]
            ],
            'Scented Oils' => [
                'products' => [
                    ['name' => 'Lavender Scented Oil', 'variants' => ['10ml', '30ml'], 'unit' => 'ml', 'regular_price' => 200],
                    ['name' => 'Rose Scented Oil', 'variants' => ['15ml', '30ml'], 'unit' => 'ml', 'regular_price' => 220],
                    ['name' => 'Sandalwood Scented Oil', 'variants' => ['10ml', '25ml'], 'unit' => 'ml', 'regular_price' => 250],
                    ['name' => 'Jasmine Scented Oil', 'variants' => ['15ml', '30ml'], 'unit' => 'ml', 'regular_price' => 230],
                    ['name' => 'Citrus Scented Oil', 'variants' => ['10ml', '20ml'], 'unit' => 'ml', 'regular_price' => 210],
                ],
                'attributes' => [
                    'color' => 'Clear, Yellow',
                    'size' => 'Small',
                    'weight' => '10g, 30g',
                    'flavor' => 'Lavender, Rose'
                ]
            ],

            // Nail Care
            'Nail Polish' => [
                'products' => [
                    ['name' => 'Red Nail Polish', 'variants' => ['10ml', '15ml'], 'unit' => 'ml', 'regular_price' => 150],
                    ['name' => 'Pink Nail Polish', 'variants' => ['10ml', '15ml'], 'unit' => 'ml', 'regular_price' => 140],
                    ['name' => 'Nude Nail Polish', 'variants' => ['10ml', '15ml'], 'unit' => 'ml', 'regular_price' => 130],
                    ['name' => 'Glitter Nail Polish', 'variants' => ['10ml', '15ml'], 'unit' => 'ml', 'regular_price' => 160],
                    ['name' => 'Matte Black Nail Polish', 'variants' => ['10ml', '15ml'], 'unit' => 'ml', 'regular_price' => 170],
                ],
                'attributes' => [
                    'color' => 'Red, Pink, Black',
                    'size' => 'Standard',
                    'weight' => '10g',
                    'flavor' => 'Unscented'
                ]
            ],
            'Base Coat' => [
                'products' => [
                    ['name' => 'Clear Base Coat', 'variants' => ['10ml', '15ml'], 'unit' => 'ml', 'regular_price' => 100],
                    ['name' => 'Strengthening Base Coat', 'variants' => ['10ml', '15ml'], 'unit' => 'ml', 'regular_price' => 120],
                    ['name' => 'Quick-Dry Base Coat', 'variants' => ['10ml', '15ml'], 'unit' => 'ml', 'regular_price' => 110],
                    ['name' => 'Matte Base Coat', 'variants' => ['10ml', '15ml'], 'unit' => 'ml', 'regular_price' => 115],
                    ['name' => 'Glossy Base Coat', 'variants' => ['10ml', '15ml'], 'unit' => 'ml', 'regular_price' => 105],
                ],
                'attributes' => [
                    'color' => 'Clear',
                    'size' => 'Standard',
                    'weight' => '10g',
                    'flavor' => 'Unscented'
                ]
            ],
            'Top Coat' => [
                'products' => [
                    ['name' => 'Glossy Top Coat', 'variants' => ['10ml', '15ml'], 'unit' => 'ml', 'regular_price' => 110],
                    ['name' => 'Matte Top Coat', 'variants' => ['10ml', '15ml'], 'unit' => 'ml', 'regular_price' => 120],
                    ['name' => 'Quick-Dry Top Coat', 'variants' => ['10ml', '15ml'], 'unit' => 'ml', 'regular_price' => 130],
                    ['name' => 'UV-Protect Top Coat', 'variants' => ['10ml', '15ml'], 'unit' => 'ml', 'regular_price' => 140],
                    ['name' => 'Long-Lasting Top Coat', 'variants' => ['10ml', '15ml'], 'unit' => 'ml', 'regular_price' => 125],
                ],
                'attributes' => [
                    'color' => 'Clear',
                    'size' => 'Standard',
                    'weight' => '10g',
                    'flavor' => 'Unscented'
                ]
            ],
            'Nail Treatments' => [
                'products' => [
                    ['name' => 'Nail Strengthener', 'variants' => ['10ml', '15ml'], 'unit' => 'ml', 'regular_price' => 200],
                    ['name' => 'Cuticle Oil', 'variants' => ['10ml', '15ml'], 'unit' => 'ml', 'regular_price' => 180],
                    ['name' => 'Nail Repair Serum', 'variants' => ['10ml', '15ml'], 'unit' => 'ml', 'regular_price' => 220],
                    ['name' => 'Growth Booster', 'variants' => ['10ml', '15ml'], 'unit' => 'ml', 'regular_price' => 210],
                    ['name' => 'Hydrating Nail Cream', 'variants' => ['10ml', '15ml'], 'unit' => 'ml', 'regular_price' => 190],
                ],
                'attributes' => [
                    'color' => 'Clear',
                    'size' => 'Standard',
                    'weight' => '10g',
                    'flavor' => 'Unscented'
                ]
            ],
            'Cuticle Care' => [
                'products' => [
                    ['name' => 'Cuticle Cream', 'variants' => ['15g', '30g'], 'unit' => 'g', 'regular_price' => 150],
                    ['name' => 'Cuticle Softener', 'variants' => ['10ml', '20ml'], 'unit' => 'ml', 'regular_price' => 140],
                    ['name' => 'Cuticle Oil Pen', 'variants' => ['5ml', '10ml'], 'unit' => 'ml', 'regular_price' => 160],
                    ['name' => 'Cuticle Remover', 'variants' => ['15ml', '30ml'], 'unit' => 'ml', 'regular_price' => 170],
                    ['name' => 'Cuticle Balm', 'variants' => ['10g', '20g'], 'unit' => 'g', 'regular_price' => 155],
                ],
                'attributes' => [
                    'color' => 'Clear, Cream',
                    'size' => 'Small',
                    'weight' => '10g, 20g',
                    'flavor' => 'Unscented'
                ]
            ],

            // Body Care
            'Body Lotion' => [
                'products' => [
                    ['name' => 'Hydrating Body Lotion', 'variants' => ['200ml', '400ml'], 'unit' => 'ml', 'regular_price' => 300],
                    ['name' => 'Shea Butter Lotion', 'variants' => ['250ml', '500ml'], 'unit' => 'ml', 'regular_price' => 350],
                    ['name' => 'Aloe Vera Lotion', 'variants' => ['200ml', '400ml'], 'unit' => 'ml', 'regular_price' => 320],
                    ['name' => 'Coconut Body Lotion', 'variants' => ['250ml', '500ml'], 'unit' => 'ml', 'regular_price' => 340],
                    ['name' => 'Lavender Body Lotion', 'variants' => ['200ml', '400ml'], 'unit' => 'ml', 'regular_price' => 330],
                ],
                'attributes' => [
                    'color' => 'White, Cream',
                    'size' => 'Medium, Large',
                    'weight' => '200g, 400g',
                    'flavor' => 'Coconut, Lavender'
                ]
            ],
            'Body Scrubs' => [
                'products' => [
                    ['name' => 'Sugar Scrub', 'variants' => ['200g', '400g'], 'unit' => 'g', 'regular_price' => 400],
                    ['name' => 'Salt Scrub', 'variants' => ['250g', '500g'], 'unit' => 'g', 'regular_price' => 420],
                    ['name' => 'Coffee Scrub', 'variants' => ['200g', '400g'], 'unit' => 'g', 'regular_price' => 450],
                    ['name' => 'Oatmeal Scrub', 'variants' => ['250g', '500g'], 'unit' => 'g', 'regular_price' => 430],
                    ['name' => 'Citrus Scrub', 'variants' => ['200g', '400g'], 'unit' => 'g', 'regular_price' => 410],
                ],
                'attributes' => [
                    'color' => 'Brown, White',
                    'size' => 'Medium, Large',
                    'weight' => '200g, 400g',
                    'flavor' => 'Coffee, Citrus'
                ]
            ],
            'Body Oils' => [
                'products' => [
                    ['name' => 'Argan Body Oil', 'variants' => ['100ml', '200ml'], 'unit' => 'ml', 'regular_price' => 500],
                    ['name' => 'Coconut Body Oil', 'variants' => ['150ml', '300ml'], 'unit' => 'ml', 'regular_price' => 480],
                    ['name' => 'Jojoba Body Oil', 'variants' => ['100ml', '200ml'], 'unit' => 'ml', 'regular_price' => 490],
                    ['name' => 'Rosehip Body Oil', 'variants' => ['150ml', '300ml'], 'unit' => 'ml', 'regular_price' => 510],
                    ['name' => 'Almond Body Oil', 'variants' => ['100ml', '200ml'], 'unit' => 'ml', 'regular_price' => 470],
                ],
                'attributes' => [
                    'color' => 'Clear, Golden',
                    'size' => 'Medium, Large',
                    'weight' => '100g, 200g',
                    'flavor' => 'Coconut, Almond'
                ]
            ],
            'Shower Gel' => [
                'products' => [
                    ['name' => 'Citrus Shower Gel', 'variants' => ['250ml', '500ml'], 'unit' => 'ml', 'regular_price' => 300],
                    ['name' => 'Lavender Shower Gel', 'variants' => ['300ml', '600ml'], 'unit' => 'ml', 'regular_price' => 320],
                    ['name' => 'Mint Shower Gel', 'variants' => ['250ml', '500ml'], 'unit' => 'ml', 'regular_price' => 310],
                    ['name' => 'Vanilla Shower Gel', 'variants' => ['300ml', '600ml'], 'unit' => 'ml', 'regular_price' => 330],
                    ['name' => 'Rose Shower Gel', 'variants' => ['250ml', '500ml'], 'unit' => 'ml', 'regular_price' => 315],
                ],
                'attributes' => [
                    'color' => 'Clear, Purple',
                    'size' => 'Medium, Large',
                    'weight' => '250g, 500g',
                    'flavor' => 'Citrus, Vanilla'
                ]
            ],
            'Body Butter' => [
                'products' => [
                    ['name' => 'Shea Body Butter', 'variants' => ['200g', '400g'], 'unit' => 'g', 'regular_price' => 450],
                    ['name' => 'Cocoa Body Butter', 'variants' => ['250g', '500g'], 'unit' => 'g', 'regular_price' => 470],
                    ['name' => 'Mango Body Butter', 'variants' => ['200g', '400g'], 'unit' => 'g', 'regular_price' => 460],
                    ['name' => 'Vanilla Body Butter', 'variants' => ['250g', '500g'], 'unit' => 'g', 'regular_price' => 480],
                    ['name' => 'Lavender Body Butter', 'variants' => ['200g', '400g'], 'unit' => 'g', 'regular_price' => 455],
                ],
                'attributes' => [
                    'color' => 'Cream, Yellow',
                    'size' => 'Medium, Large',
                    'weight' => '200g, 400g',
                    'flavor' => 'Cocoa, Lavender'
                ]
            ],
        ];

        foreach ($categories as $category) {
            $isSubcategory = $category->parent_id !== null;

            foreach ($sampleProducts as $categoryName => $data) {
                if (Str::slug($category->categoryName) === Str::slug($categoryName)) {
                    foreach ($data['products'] as $product) {
                        $randomBrandId = $brands[array_rand($brands)];
                        $randomTagId = $tagNames[array_rand($tagNames)];

                        // Insert product
                        $productId = DB::table('products')->insertGetId([
                            'product_name' => $product['name'],
                            'slug' => Str::slug($product['name']),
                            'category_id' => $isSubcategory ? $category->parent_id : $category->id,
                            'subcategory_id' => $isSubcategory ? $category->id : null,
                            'brand_id' => $randomBrandId,
                            'unit_id' => $product['unit'],
                            'sku' => Str::random(10),
                            'created_by' => 1,
                            'status' => 1,
                            'created_at' => now(),
                            'updated_at' => now()
                        ]);

                        // Insert product details
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

                        // Insert product tags
                        DB::table('product_tags')->insert([
                            'product_id' => $productId,
                            'tag_id' => $randomTagId,
                            'created_at' => now(),
                            'updated_at' => now()
                        ]);

                        // Insert variants for this product with status
                        $isFirstVariant = true;
                        foreach ($product['variants'] as $variant) {
                            $variantId = DB::table('variants')->insertGetId([
                                'product_id' => $productId,
                                'variant_name' => $variant,
                                'color' => $data['attributes']['color'] ?? null,
                                'size' => $data['attributes']['size'] ?? null,
                                'weight' => $data['attributes']['weight'] ?? null,
                                'flavor' => $data['attributes']['flavor'] ?? null,
                                'regular_price' => $product['regular_price'] ?? null,
                                'status' => $isFirstVariant ? 'Default' : 'Variant',
                                'created_at' => now(),
                                'updated_at' => now()
                            ]);



                            $isFirstVariant = false; // Only first variant gets 'Default' status
                        }
                    }
                }
            }
        }
    }
}
