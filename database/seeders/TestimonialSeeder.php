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
                'name' => 'Ahmad Fauzi',
                'user_id' => null,
                'content' => 'Alhamdulillah, perjalanan umroh sangat nyaman dan berkah. Pelayanan dari travel sangat memuaskan, guide yang ramah dan berpengalaman.',
                'rating' => 5,
                'created_at' => Carbon::now()->subDays(30),
                'updated_at' => Carbon::now()->subDays(30),
            ],
            [
                'name' => 'Siti Nurhaliza',
                'user_id' => null,
                'content' => 'Paket VIP benar-benar worth it! Hotel dekat masjid, makanan enak, dan bimbingan ibadah yang sangat membantu.',
                'rating' => 5,
                'created_at' => Carbon::now()->subDays(25),
                'updated_at' => Carbon::now()->subDays(25),
            ],
            [
                'name' => 'Budi Santoso',
                'user_id' => null,
                'content' => 'Pengalaman pertama umroh yang tak terlupakan. Semua terorganisir dengan baik, dari keberangkatan sampai kepulangan.',
                'rating' => 4,
                'created_at' => Carbon::now()->subDays(20),
                'updated_at' => Carbon::now()->subDays(20),
            ],
            [
                'name' => 'Dewi Lestari',
                'user_id' => null,
                'content' => 'Travel umroh terpercaya! Proses pendaftaran mudah, pelayanan ramah, dan harga terjangkau. Sangat direkomendasikan.',
                'rating' => 5,
                'created_at' => Carbon::now()->subDays(15),
                'updated_at' => Carbon::now()->subDays(15),
            ],
            [
                'name' => 'Muhammad Rizki',
                'user_id' => null,
                'content' => 'Perjalanan ibadah yang sangat berkesan. Tim travel sangat membantu dan perhatian kepada jamaah. Jazakumullah khairan.',
                'rating' => 5,
                'created_at' => Carbon::now()->subDays(10),
                'updated_at' => Carbon::now()->subDays(10),
            ],
            [
                'name' => 'Fatimah Azzahra',
                'user_id' => null,
                'content' => 'Pelayanan memuaskan, hotel nyaman, dan makanan sesuai selera Indonesia. Puas dengan paket yang dipilih.',
                'rating' => 4,
                'created_at' => Carbon::now()->subDays(7),
                'updated_at' => Carbon::now()->subDays(7),
            ],
            [
                'name' => 'Hasan Basri',
                'user_id' => null,
                'content' => 'Alhamdulillah lancar dari awal sampai akhir. Mutawwif sangat berpengalaman dan sabar membimbing kami.',
                'rating' => 5,
                'created_at' => Carbon::now()->subDays(5),
                'updated_at' => Carbon::now()->subDays(5),
            ],
            [
                'name' => 'Aisyah Rahmawati',
                'user_id' => null,
                'content' => 'Pengalaman spiritual yang luar biasa. Terima kasih atas pelayanan dan bimbingan yang diberikan selama di tanah suci.',
                'rating' => 5,
                'created_at' => Carbon::now()->subDays(3),
                'updated_at' => Carbon::now()->subDays(3),
            ]
        ];

        DB::table('testimonials')->insert($testimonials);
    }
}
