<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ShoppingCartsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('shopping_carts')->insert([
            [
                'user_id' => 2,
                'product_option_id' => 1,
                'quantity' => 3,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'user_id' => 2,
                'product_option_id' => 2,
                'quantity' => 5,
                'created_at' => now(),
                'updated_at' => now()
            ],
        ]);
    }
}
