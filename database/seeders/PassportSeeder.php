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
                'isActive' => true,
                'updated_at' => Carbon::now(),
            ],
            [
                'user_id' => 3,
                'passportName' => 'Budi Santoso',
                'isActive' => false,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'user_id' => 5,
                'passportName' => 'Rudi Hermawan',
                'isActive' => true,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]
        ];

        DB::table('passports')->insert($passports);

        // Documents untuk semua user - Updated structure
        $documents = [
            // User 1
            [
                'user_id' => 1,
                'ktp' => 'documents/user1/ktp.jpg',
                'kk' => 'documents/user1/kk.jpg',
                'dokumen_pendukung' => null,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            // User 2
            [
                'user_id' => 2,
                'ktp' => 'documents/user2/ktp.jpg',
                'kk' => null,
                'dokumen_pendukung' => json_encode(['documents/user2/birth-cert.jpg']),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            // User 3
            [
                'user_id' => 3,
                'ktp' => 'documents/user3/ktp.jpg',
                'kk' => null,
                'dokumen_pendukung' => null,
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
