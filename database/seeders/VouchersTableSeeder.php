<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class VouchersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('vouchers')->insert([
            [
                'name' => 'menvn70',
                'value' => 70,
                'require_money' => 200000,
                'description' => 'Nhân ngày đàn ông Việt Nam, vì tôn vinh những đóng góp và hy sinh âm thầm của họ chúng tôi đã tạo mã giảm giá này!',
                'quantity' => 50,
                'count_use' => 0,
                'date_expired' => '2023-05-07',
                'status' => 1,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'poly500',
                'value' => 500000,
                'require_money' => null,
                'description' => 'Vì tôn vinh những đóng góp vào giáo dục của FPT Polytechnic chúng tôi đã tạo mã giảm giá này!',
                'quantity' => 1,
                'count_use' => 0,
                'date_expired' => '2023-05-08',
                'status' => 1,
                'created_at' => now(),
                'updated_at' => now()
            ],
        ]);
    }
}
