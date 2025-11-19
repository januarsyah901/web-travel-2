<?php
// database/seeders/PassportSeeder.php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class PassportSeeder extends Seeder
{
    public function run()
    {
        // Passports untuk user yang memiliki passport
        $passports = [
            [
                'user_id' => 1,
                'passportName' => 'Ahmad Rizki',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'user_id' => 3,
                'passportName' => 'Budi Santoso',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'user_id' => 5,
                'passportName' => 'Rudi Hermawan',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]
        ];

        DB::table('passports')->insert($passports);

        // Documents untuk semua user
        $documents = [
            // User 1
            [
                'user_id' => 1,
                'type' => 'ktp',
                'file_path' => 'documents/user1/ktp.jpg',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'user_id' => 1,
                'type' => 'kk',
                'file_path' => 'documents/user1/kk.jpg',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            // User 2
            [
                'user_id' => 2,
                'type' => 'ktp',
                'file_path' => 'documents/user2/ktp.jpg',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'user_id' => 2,
                'type' => 'birthCert',
                'file_path' => 'documents/user2/birth-cert.jpg',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            // User 3
            [
                'user_id' => 3,
                'type' => 'ktp',
                'file_path' => 'documents/user3/ktp.jpg',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'user_id' => 3,
                'type' => 'photo',
                'file_path' => 'documents/user3/photo.jpg',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]
        ];

        DB::table('documents')->insert($documents);

        // Passport photos
        $passportPhotos = [
            [
                'passport_id' => 1,
                'file_path' => 'passport-photos/passport1-photo1.jpg',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'passport_id' => 2,
                'file_path' => 'passport-photos/passport2-photo1.jpg',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'passport_id' => 3,
                'file_path' => 'passport-photos/passport3-photo1.jpg',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]
        ];

        DB::table('passport_photos')->insert($passportPhotos);
    }
}
