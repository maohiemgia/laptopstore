<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SubCategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('sub_categories')->insert([
            [
                'name' => 'Legion',
                'category_id' => 2,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'IdeaPad',
                'category_id' => 2,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Yoga',
                'category_id' => 6,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'PinkPink',
                'category_id' => 6,
                'created_at' => now(),
                'updated_at' => now()
            ],
        ]);
    }
}
