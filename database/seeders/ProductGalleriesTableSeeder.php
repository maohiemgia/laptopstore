<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductGalleriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('product_galleries')->insert([
            [
                'image' => '/images/legion1a.png', 
                'product_id' => 5, 
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'image' => '/images/legion1b.png', 
                'product_id' => 5, 
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'image' => '/images/legion1c.png', 
                'product_id' => 5,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'image' => '/images/legion1d.png', 
                'product_id' => 5, 
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'image' => '/images/legion1e.png', 
                'product_id' => 5, 
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'image' => '/images/legion1f.png', 
                'product_id' => 5, 
                'created_at' => now(),
                'updated_at' => now()
            ],
        ]);
    }
}
