<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class BrandSeed extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $brands = [
            [
                'BrandName' => 'L\'Oréal Paris',
                'image' => 'loreal-paris.jpg'
            ],
            [
                'BrandName' => 'Maybelline New York',
                'image' => 'maybelline-new-york.jpg'
            ],
            [
                'BrandName' => 'Estée Lauder',
                'image' => 'estee-lauder.jpg'
            ],
            [
                'BrandName' => 'MAC Cosmetics',
                'image' => 'mac-cosmetics.jpg'
            ],
            [
                'BrandName' => 'NARS Cosmetics',
                'image' => 'nars-cosmetics.jpg'
            ],
            [
                'BrandName' => 'Clinique',
                'image' => 'clinique.jpg'
            ],
            [
                'BrandName' => 'The Ordinary',
                'image' => 'the-ordinary.jpg'
            ],
            [
                'BrandName' => 'Lancôme',
                'image' => 'lancome.jpg'
            ],
            [
                'BrandName' => 'Revlon',
                'image' => 'revlon.jpg'
            ],
            [
                'BrandName' => 'Charlotte Tilbury',
                'image' => 'charlotte-tilbury.jpg'
            ],
            [
                'BrandName' => 'Fenty Beauty',
                'image' => 'fenty-beauty.jpg'
            ],
            [
                'BrandName' => 'Too Faced',
                'image' => 'too-faced.jpg'
            ],
            [
                'BrandName' => 'Urban Decay',
                'image' => 'urban-decay.jpg'
            ],
            [
                'BrandName' => 'Yves Saint Laurent',
                'image' => 'yves-saint-laurent.jpg'
            ],
            [
                'BrandName' => 'Dior Beauty',
                'image' => 'dior-beauty.jpg'
            ],
            [
                'BrandName' => 'Shiseido',
                'image' => 'shiseido.jpg'
            ],
            [
                'BrandName' => 'Guerlain',
                'image' => 'guerlain.jpg'
            ],
            [
                'BrandName' => 'Benefit Cosmetics',
                'image' => 'benefit-cosmetics.jpg'
            ],
            [
                'BrandName' => 'Tarte Cosmetics',
                'image' => 'tarte-cosmetics.jpg'
            ],
            [
                'BrandName' => 'NYX Professional Makeup',
                'image' => 'nyx-professional-makeup.jpg'
            ]
        ];

        foreach ($brands as $brand) {
            DB::table('brands')->insert([
                'BrandName' => $brand['BrandName'],
                'slug' => Str::slug($brand['BrandName']),
                'image' => $brand['image'],
                'status' => 1,
                'created_at' => now(),
                'updated_at' => now()
            ]);
        }
    }
}
