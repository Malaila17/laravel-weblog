<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ArticleCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $numberOfEntries = 100;

        for ($i = 0; $i < $numberOfEntries; $i++) {
            DB::table('article_category')->insert([
                'article_id' => rand(1, 30),
                'category_id' => rand(1, 15),
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
