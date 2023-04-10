<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BannersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('banners')->insert([
            [
                'image' => '/images/banner1.jpg',
                'location' => 1,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'image' => '/images/banner2.jpg',
                'location' => 1,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'image' => '/images/banner3.jpg',
                'location' => 1,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'image' => '/images/banner4.jpg',
                'location' => 1,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'image' => '/images/banner5.jpg',
                'location' => 1,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'image' => '/images/banner6.jpg',
                'location' => 0,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'image' => '/images/banner7.jpg',
                'location' => 0,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'image' => '/images/banner8.jpg',
                'location' => 0,
                'created_at' => now(),
                'updated_at' => now()
            ]
        ]);
    }
}
