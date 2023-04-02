<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class WebSettingsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('web_settings')->insert([
            'name' => 'Lenovo Laptop Store',
            'email' => 'tuannvph19078@fpt.edu.vn',
            'phone_number_support' => '0342.737.862',
            'phone_number_technical' => '0342.737.862',
            'address' => 'FPT Polytechnic',
            'created_at' => now(),
            'updated_at' => now()
        ]);
    }
}
