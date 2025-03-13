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
                    ['tagName' => 'Face Care'],
                    ['tagName' => 'Hair Treatment'],
                    ['tagName' => 'Cosmetics'],
                    ['tagName' => 'Workout'],
                    ['tagName' => 'Self-Care'],
                    ['tagName' => 'Healthy Eating'],
                    ['tagName' => 'Mindfulness'],
                    ['tagName' => 'Natural Beauty'],
                    ['tagName' => 'Relaxation Therapy'],
                    ['tagName' => 'Youthful Skin']
            ];

            DB::table('tag_names')->insert($tags);
    }
}
