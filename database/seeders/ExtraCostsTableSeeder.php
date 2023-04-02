<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ExtraCostsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('extra_costs')->insert([
            [
                'zip_code' => '0',
                'shipping_fee' => 100000,
                'tax' => 0,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'zip_code' => '90000',
                'shipping_fee' => 200000,
                'tax' => 0,
                'created_at' => now(),
                'updated_at' => now()
            ],
        ]);
    }
}
