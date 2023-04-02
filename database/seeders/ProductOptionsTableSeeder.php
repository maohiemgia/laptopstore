<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductOptionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('product_options')->insert([
            [
                'product_id' => 1,
                'quantity' => 99,
                'price' => '58000000',
                'status' => 1,
                'discount_value' => 500000,
                'screen' => "14inch WUXGA (1920 x 1200), IPS, Anti-Reflective, Touch, 100%sRGB, 400 nits, Narrow Bezel",
                'cpu' => '13th Generation Intel® Core™ i5-1335U Processor (E-cores up to 3.40 GHz P-cores up to 4.60 GHz)',
                'gpu' => 'Integrated Intel® Iris® Xe Graphics',
                'ram' => '16 GB LPDDR5-6400MHz (Soldered)',
                'memory' => '256 GB SSD M.2 2280 PCIe Gen4 TLC Opal',
                'battery' => '57Whr battery | Rapid Charge (60 minutes = 80% runtime), requires 65W or higher adapter',
                'size' => 'Cao x Rộng x Sâu = 15.53mm x 314.4mm x 222.3mm x / 0.61″ x 12.38″ x 8.75″',
                'weight' => '1.38kg',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'product_id' => 3,
                'quantity' => 59,
                'price' => '55000000',
                'status' => 1,
                'discount_value' => 500000,
                'screen' => "19inch WUXGA (1920 x 1200), IPS, Anti-Reflective, Touch, 100%sRGB, 400 nits, Narrow Bezel",
                'cpu' => '18th Generation Intel® Core™ i5-1335U Processor (E-cores up to 3.40 GHz P-cores up to 4.60 GHz)',
                'gpu' => 'Integrated Intel® Iris® Xe Graphics',
                'ram' => '32 GB LPDDR5-6400MHz (Soldered)',
                'memory' => '512 GB SSD M.2 2280 PCIe Gen4 TLC Opal',
                'battery' => '57Whr battery | Rapid Charge (60 minutes = 80% runtime), requires 65W or higher adapter',
                'size' => 'Cao x Rộng x Sâu = 15.53mm x 314.4mm x 222.3mm x / 0.61″ x 12.38″ x 8.75″',
                'weight' => '1.38kg',
                'created_at' => now(),
                'updated_at' => now()
            ],

        ]);
    }
}
