<?php

namespace Database\Seeders;

use App\Models\Testimonial;
use Illuminate\Database\Seeder;

class TestimonialManualSeeder extends Seeder
{
    public function run(): void
    {
        $testimonials = [
            [
                'name' => 'deny mayasari',
                'author_photo' => '',
                'rating' => 5,
                'content' => 'Alhamdulillah ibadah lancar bersama Fabi Abadi, travel yg amanah, sangat bagus dan baik , semua kru nya sangat ramah , membimbing dengan sabar dan seperti keluarga, hotel terbaik, makanan terbaik dan saya pribadi sangat merekomendasikan …',
                'review_time' => 'a year ago',
                'review_url' => '',
            ],
            [
                'name' => 'Indah Nur',
                'author_photo' => '',
                'rating' => 5,
                'content' => 'Alhamdulillah.. seneng sekali bisa bergabung di trevel Fabi abadi.. Sejak pertama ketemu langsung terpesona dengan pelayananya yg sangat luar biasa.. seperti keluarga sendiri , masyaallah...pelayanan yg profesional, sehingga mempermudah kami yg masih awal ibadah umroh..',
                'review_time' => 'a year ago',
                'review_url' => '',
            ],
            [
                'name' => 'nurainamala h3tcomp',
                'author_photo' => '',
                'rating' => 5,
                'content' => 'Travel yang amanah, terima kasih sudah memberikan pelayanan yg terbaik untuk ibadah kami sekeluarga. Semoga semakin sukses dan tetap amanah',
                'review_time' => 'a year ago',
                'review_url' => '',
            ],
            [
                'name' => 'Siti Fatimah',
                'author_photo' => '',
                'rating' => 5,
                'content' => 'Terbaik, MasyaAllah Tabarakallah Sudah pernah umrah dan haji di FABI ABADI pelayanan oke, terbaik, dan bisa amanah',
                'review_time' => 'a year ago',
                'review_url' => '',
            ],
            [
                'name' => 'Afiyah Fabi',
                'author_photo' => '',
                'rating' => 5,
                'content' => 'Alhamdulillah, Fabi abadi memang Top markotop.. Semoga selalu di lindungi dan mendapatkan barokah dari Alloh SWT 🤲🤲🤲🤲 …',
                'review_time' => '4 years ago',
                'review_url' => '',
            ],
            [
                'name' => 'Samsi Oki',
                'author_photo' => '',
                'rating' => 5,
                'content' => 'Aman Dan terpercaya Keberangkatan Sesuai jadual',
                'review_time' => '11 months ago',
                'review_url' => '',
            ],
            [
                'name' => 'Sunariyah Riyah',
                'author_photo' => '',
                'rating' => 5,
                'content' => 'Alhamdulillah Amanah, Terpercaya, Pelayanan Terbaik',
                'review_time' => '11 months ago',
                'review_url' => '',
            ],
            [
                'name' => 'Cimoy Nesia',
                'author_photo' => '',
                'rating' => 5,
                'content' => 'Servis motor disini ok banget,dilayani dengan ramah,tekhnik nya juga ok,hasil servisannya puas banget',
                'review_time' => '4 years ago',
                'review_url' => '',
            ],
            [
                'name' => 'Umar Faruk',
                'author_photo' => '',
                'rating' => 5,
                'content' => 'Tempat nya enak..depan jalan raya parkir mobil Mudah',
                'review_time' => '7 years ago',
                'review_url' => '',
            ],
            [
                'name' => 'Azrul',
                'author_photo' => '',
                'rating' => 5,
                'content' => 'Pelayanan bagus, mutowifnya ramah,sabar👍👍 …',
                'review_time' => 'a year ago',
                'review_url' => '',
            ],
            [
                'name' => 'akhmad effendi',
                'author_photo' => '',
                'rating' => 5,
                'content' => 'Masya\'AlloH pelayanan sangat memuaskan',
                'review_time' => 'a year ago',
                'review_url' => '',
            ],
            [
                'name' => 'Ammar Ammar',
                'author_photo' => '',
                'rating' => 5,
                'content' => 'Dipercaya selalu amanah',
                'review_time' => '9 months ago',
                'review_url' => '',
            ],
            [
                'name' => 'soraya nazalia',
                'author_photo' => '',
                'rating' => 5,
                'content' => 'Pelayanannya okee bgtt!',
                'review_time' => 'a year ago',
                'review_url' => '',
            ],
            [
                'name' => 'Defal Umar',
                'author_photo' => '',
                'rating' => 5,
                'content' => 'sangat bagus sekali',
                'review_time' => '7 years ago',
                'review_url' => '',
            ],
            [
                'name' => 'Budi Joko',
                'author_photo' => '',
                'rating' => 5,
                'content' => 'amanah mantap',
                'review_time' => 'a year ago',
                'review_url' => '',
            ],
        ];

        foreach ($testimonials as $testimonial) {
            Testimonial::create($testimonial);
        }
    }
}
