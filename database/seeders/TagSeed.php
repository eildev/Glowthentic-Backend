<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
class TagSeed extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

            $tags = [
                ['tagName' => 'Skincare'],
                ['tagName' => 'Haircare'],
                ['tagName' => 'Makeup'],
                ['tagName' => 'Fitness'],
                ['tagName' => 'Wellness'],
                ['tagName' => 'Nutrition'],
                ['tagName' => 'Mental Health'],
                ['tagName' => 'Organic Beauty'],
                ['tagName' => 'Spa & Relaxation'],
                ['tagName' => 'Anti-Aging'],
            ];

            DB::table('tag_names')->insert($tags);
    }
}
