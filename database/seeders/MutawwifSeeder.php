<?php
// database/seeders/MutawwifSeeder.php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class MutawwifSeeder extends Seeder
{
    public function run()
    {
        $mutawwifs = [
            [
                'name' => 'Ustadz Abdul Rahman',
                'description' => 'Pengalaman 10 tahun sebagai pembimbing umroh, menguasai bahasa Arab dan Inggris.',
                'photo_path' => 'mutawwifs/ustadz-abdul.jpg',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name' => 'Ustadzah Fatimah Az Zahra',
                'description' => 'Spesialis pembimbing jamaah wanita, alumni Universitas Madinah.',
                'photo_path' => 'mutawwifs/ustadzah-fatimah.jpg',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name' => 'Ustadz Ahmad Al Habsyi',
                'description' => 'Berkeliling dunia untuk dakwah, pengalaman 15 tahun memandu umroh dan haji.',
                'photo_path' => 'mutawwifs/ustadz-ahmad.jpg',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]
        ];

        DB::table('mutawwifs')->insert($mutawwifs);
    }
}
