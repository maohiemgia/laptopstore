<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class FollowersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Define the follower data
        $followers = [
            [
                'email' => 'johndoe@example.com',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'email' => 'janesmith@example.com',
                'created_at' => now(),
                'updated_at' => now()
            ],
            // Add more followers as needed
        ];

        // Insert the follower data into the 'followers' table
        DB::table('followers')->insert($followers);
    }
}
