<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('categories')->insert([
            ['name' => 'Dell', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Lenovo', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'HP', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Asus', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Acer', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Apple', 'created_at' => now(), 'updated_at' => now()],
        ]);
    }
}
