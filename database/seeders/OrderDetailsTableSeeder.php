<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class OrderDetailsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('order_details')->insert([
            [
                'order_id' => 1,
                'product_option_id' => 1,
                'product_detail' => 'laptop lenovo legion cpu i8 gpu gtx 3050 ram 32gb memory 512GB',
                'quantity' => 1,
                'price' => 58000000,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'order_id' => 1,
                'product_option_id' => 2,
                'product_detail' => 'laptop lenovo legion cpu i8 gpu gtx 3050 ram 32gb memory 512GB',
                'quantity' => 3,
                'price' => 878000000,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'order_id' => 2,
                'product_option_id' => 1,
                'product_detail' => 'laptop lenovo legion cpu i8 gpu gtx 3050 ram 32gb memory 512GB',
                'quantity' => 1,
                'price' => 58000000,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'order_id' => 3,
                'product_option_id' => 1,
                'product_detail' => 'laptop lenovo legion cpu i8 gpu gtx 3050 ram 32gb memory 512GB',
                'quantity' => 1,
                'price' => 58000000,
                'created_at' => now(),
                'updated_at' => now()
            ],

        ]);
    }
}
