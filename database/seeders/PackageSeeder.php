<?php
// database/seeders/PackageSeeder.php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class PackageSeeder extends Seeder
{
    public function run()
    {
        $packages = [
            [
                'title' => 'Paket Umroh Reguler 9 Hari',
                'schedule' => '2024-03-15 s/d 2024-03-24',
                'duration' => 9,
                'price' => 35000000.00,
                'description' => 'Paket umroh reguler dengan fasilitas hotel bintang 3, makan 3x sehari, dan transportasi nyaman.',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'title' => 'Paket Umroh Plus Turki 12 Hari',
                'schedule' => '2024-04-10 s/d 2024-04-22',
                'duration' => 12,
                'price' => 45000000.00,
                'description' => 'Paket umroh plus tour ke Turki dengan mengunjungi masjid bersejarah dan tempat wisata terkenal.',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'title' => 'Paket Umroh VIP 7 Hari',
                'schedule' => '2024-05-05 s/d 2024-05-12',
                'duration' => 7,
                'price' => 55000000.00,
                'description' => 'Paket umroh VIP dengan hotel bintang 5 dekat Masjidil Haram, makan prasmanan, dan guide berpengalaman.',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'title' => 'Paket Umroh Ramadhan 14 Hari',
                'schedule' => '2024-04-01 s/d 2024-04-15',
                'duration' => 14,
                'price' => 48000000.00,
                'description' => 'Paket khusus umroh di bulan Ramadhan dengan program ibadah khusus dan buka puasa bersama.',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'title' => 'Paket Umroh Ekonomis 10 Hari',
                'schedule' => '2024-06-20 s/d 2024-06-30',
                'duration' => 10,
                'price' => 28000000.00,
                'description' => 'Paket umroh ekonomis dengan harga terjangkau namun tetap nyaman dan berkualitas.',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]
        ];

        DB::table('packages')->insert($packages);
    }
}
