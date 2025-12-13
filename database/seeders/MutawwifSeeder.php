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
                'specialization' => 'Translator dan Pembimbing',
                'photo_path' => 'mutawwifs/ustadz-abdul.jpg',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name' => 'Ustadzah Fatimah Az Zahra',
                'specialization' => 'Pembimbing Jamaah Wanita',
                'photo_path' => 'mutawwifs/ustadzah-fatimah.jpg',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name' => 'Ustadz Ahmad Al Habsyi',
                'specialization' => 'Pembimbing Utama',
                'photo_path' => 'mutawwifs/ustadz-ahmad.jpg',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name' => 'Ustadzah Siti Nurhaliza',
                'specialization' => 'Pembimbing Jamaah Wanita',
                'photo_path' => 'mutawwifs/ustadzah-siti.jpg',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name' => 'Ustadz Muhammad Yusuf',
                'specialization' => 'Translator dan Pembimbing',
                'photo_path' => 'mutawwifs/ustadz-muhammad.jpg',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]
        ];

        DB::table('mutawwifs')->insert($mutawwifs);
    }
}
