<?php
// database/seeders/PartnerSeeder.php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class PartnerSeeder extends Seeder
{
    public function run()
    {
        $partners = [
            [
                'name' => 'Saudi Airlines',
                'logo_path' => 'partners/saudi-airlines.png',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name' => 'Hotel Al Marwa',
                'logo_path' => 'partners/hotel-al-marwa.png',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name' => 'BIMTRAVEL',
                'logo_path' => 'partners/bimtravel.png',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name' => 'Kemenag RI',
                'logo_path' => 'partners/kemenag.png',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]
        ];

        DB::table('partners')->insert($partners);
    }
}
