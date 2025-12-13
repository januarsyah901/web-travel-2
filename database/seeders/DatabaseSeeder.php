<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\Admin;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            UserSeeder::class,
            PackageSeeder::class,
            MutawwifSeeder::class,
            PartnerSeeder::class,
            PassportSeeder::class, // Ini sudah include documents dan passport_photos
            BookingSeeder::class,
            TestimonialSeeder::class,
            AdminSeeder::class,
        ]);
    }
}
