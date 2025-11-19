<?php
// database/seeders/BookingSeeder.php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class BookingSeeder extends Seeder
{
    public function run()
    {
        $bookings = [
            [
                'user_id' => 1,
                'package_id' => 1,
                'status' => 'confirmed',
                'registered_at' => Carbon::now()->subDays(10),
                'created_at' => Carbon::now()->subDays(15),
                'updated_at' => Carbon::now()->subDays(5),
            ],
            [
                'user_id' => 2,
                'package_id' => 2,
                'status' => 'pending',
                'registered_at' => Carbon::now()->subDays(5),
                'created_at' => Carbon::now()->subDays(7),
                'updated_at' => Carbon::now()->subDays(5),
            ],
            [
                'user_id' => 3,
                'package_id' => 3,
                'status' => 'confirmed',
                'registered_at' => Carbon::now()->subDays(3),
                'created_at' => Carbon::now()->subDays(5),
                'updated_at' => Carbon::now()->subDays(2),
            ],
            [
                'user_id' => 4,
                'package_id' => 4,
                'status' => 'cancelled',
                'registered_at' => Carbon::now()->subDays(20),
                'created_at' => Carbon::now()->subDays(25),
                'updated_at' => Carbon::now()->subDays(18),
            ]
        ];

        DB::table('bookings')->insert($bookings);
    }
}
