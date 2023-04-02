<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class OrdersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('orders')->insert([
            [
                'user_id' => 2,
                'customer_name' => 'tuandz',
                'customer_email' => 'tuannvph19078@fpt.edu.vn',
                'customer_address' => 'fpt polytechnic hn',
                'customer_phone_number' => '0342 737 862',
                'tax_fee' => 0,
                'shipping_fee' => '30000',
                'payment_type' => 0,
                'total_cost' => 99999999,
                'discount_value' => 100000,
                'note' => 'nhà ở đối diện trường học FPT POLY',
                'date_receive' => null,
                'status' => 1,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'user_id' => null,
                'customer_name' => 'tuandz',
                'customer_email' => 'tuannvph19078@fpt.edu.vn',
                'customer_address' => 'fpt polytechnic hn',
                'customer_phone_number' => '0342 737 862',
                'tax_fee' => 0,
                'shipping_fee' => '30000',
                'payment_type' => 0,
                'total_cost' => 99999999,
                'discount_value' => 100000,
                'note' => 'nhà ở đối diện trường học FPT POLY',
                'date_receive' => null,
                'status' => 2,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'user_id' => null,
                'customer_name' => 'tuandz',
                'customer_email' => 'tuannvph19078@fpt.edu.vn',
                'customer_address' => 'fpt polytechnic hn',
                'customer_phone_number' => '0342 737 862',
                'tax_fee' => 0,
                'shipping_fee' => '30000',
                'payment_type' => 0,
                'total_cost' => 99999999,
                'discount_value' => 100000,
                'note' => 'nhà ở đối diện trường học FPT POLY',
                'date_receive' => null,
                'status' => 0,
                'created_at' => now(),
                'updated_at' => now()
            ],

        ]);
    }
}
