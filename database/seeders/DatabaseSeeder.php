<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\ProductGallery;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            CategoriesTableSeeder::class,
            SubCategoriesTableSeeder::class,
            ProductsTableSeeder::class,
            ProductOptionsTableSeeder::class,
            ProductGalleriesTableSeeder::class,
            UsersTableSeeder::class,
            VouchersTableSeeder::class,
            OrdersTableSeeder::class,
            OrderDetailsTableSeeder::class,
            BannersTableSeeder::class
        ]);
    }
}
