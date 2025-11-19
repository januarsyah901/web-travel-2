<?php
// database/seeders/GallerySeeder.php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class GallerySeeder extends Seeder
{
    public function run()
    {
        $galleries = [
            [
                'title' => 'Ka\'bah di Malam Hari',
                'description' => 'Pemandangan indah Ka\'bah yang diterangi lampu di malam hari',
                'image_path' => 'galleries/kabah-malam.jpg',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'title' => 'Masjid Nabawi',
                'description' => 'Keindahan arsitektur Masjid Nabawi di Madinah',
                'image_path' => 'galleries/masjid-nabawi.jpg',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'title' => 'Jamaah Tawaf',
                'description' => 'Suasana jamaah yang sedang melaksanakan tawaf',
                'image_path' => 'galleries/jamaah-tawaf.jpg',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'title' => 'Jabal Rahmah',
                'description' => 'Bukit Rahmah tempat bersejarah di Arafah',
                'image_path' => 'galleries/jabal-rahmah.jpg',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]
        ];

        DB::table('galleries')->insert($galleries);
    }
}
