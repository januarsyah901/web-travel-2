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
        // Grab existing package and user IDs to avoid FK constraint failures
        $packageIds = DB::table('packages')->pluck('id')->toArray();
        $userIds = DB::table('users')->pluck('id')->toArray();

        // If there are no packages or users, skip seeding bookings
        if (empty($packageIds) || empty($userIds)) {
            return;
        }

        // Sample booking templates (relative indices). We'll map indices to actual IDs.
        $templates = [
            ['user_index' => 0, 'package_index' => 0, 'status' => 'confirmed', 'registered_days_ago' => 10, 'created_days_ago' => 15, 'updated_days_ago' => 5],
            ['user_index' => 1, 'package_index' => 1, 'status' => 'pending', 'registered_days_ago' => 5, 'created_days_ago' => 7, 'updated_days_ago' => 5],
            ['user_index' => 2, 'package_index' => 2, 'status' => 'confirmed', 'registered_days_ago' => 3, 'created_days_ago' => 5, 'updated_days_ago' => 2],
            ['user_index' => 3, 'package_index' => 3, 'status' => 'cancelled', 'registered_days_ago' => 20, 'created_days_ago' => 25, 'updated_days_ago' => 18],
        ];

        $bookings = [];
        $packageCount = count($packageIds);
        $userCount = count($userIds);

        foreach ($templates as $t) {
            // Map relative index to available IDs using modulo to avoid out-of-range errors
            $userId = $userIds[$t['user_index'] % $userCount];
            $packageId = $packageIds[$t['package_index'] % $packageCount];

            $bookings[] = [
                'user_id' => $userId,
                'package_id' => $packageId,
                'status' => $t['status'],
                'registered_at' => Carbon::now()->subDays($t['registered_days_ago']),
                'created_at' => Carbon::now()->subDays($t['created_days_ago']),
                'updated_at' => Carbon::now()->subDays($t['updated_days_ago']),
            ];
        }

        DB::table('bookings')->insert($bookings);
    }
}
