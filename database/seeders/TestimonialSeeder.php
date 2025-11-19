<?php
// database/seeders/TestimonialSeeder.php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class TestimonialSeeder extends Seeder
{
    public function run()
    {
        $testimonials = [
            [
                'user_id' => 1,
                'content' => 'Alhamdulillah, perjalanan umroh sangat nyaman dan berkah. Pelayanan dari travel sangat memuaskan, guide yang ramah dan berpengalaman.',
                'rating' => 5,
                'created_at' => Carbon::now()->subDays(30),
                'updated_at' => Carbon::now()->subDays(30),
            ],
            [
                'user_id' => 3,
                'content' => 'Paket VIP benar-benar worth it! Hotel dekat masjid, makanan enak, dan bimbingan ibadah yang sangat membantu.',
                'rating' => 5,
                'created_at' => Carbon::now()->subDays(15),
                'updated_at' => Carbon::now()->subDays(15),
            ],
            [
                'user_id' => 5,
                'content' => 'Pengalaman pertama umroh yang tak terlupakan. Semua terorganisir dengan baik, dari keberangkatan sampai kepulangan.',
                'rating' => 4,
                'created_at' => Carbon::now()->subDays(7),
                'updated_at' => Carbon::now()->subDays(7),
            ]
        ];

        DB::table('testimonials')->insert($testimonials);
    }
}
