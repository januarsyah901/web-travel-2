<?php
// database/seeders/UserSeeder.php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;

class UserSeeder extends Seeder
{
    public function run()
    {
        $users = [
            [
                'fullName' => 'Ahmad Rizki',
                'birthDate' => '1990-05-15',
                'address' => 'Jl. Merdeka No. 123, Jakarta Pusat',
                'phone' => '081234567890',
                'hasPassport' => true,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'fullName' => 'Siti Fatimah',
                'birthDate' => '1985-08-22',
                'address' => 'Jl. Sudirman No. 45, Bandung',
                'phone' => '081298765432',
                'hasPassport' => false,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'fullName' => 'Budi Santoso',
                'birthDate' => '1978-12-10',
                'address' => 'Jl. Gatot Subroto No. 78, Surabaya',
                'phone' => '081345678901',
                'hasPassport' => true,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'fullName' => 'Maya Sari',
                'birthDate' => '1992-03-30',
                'address' => 'Jl. Thamrin No. 56, Medan',
                'phone' => '081456789012',
                'hasPassport' => false,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'fullName' => 'Rudi Hermawan',
                'birthDate' => '1988-07-18',
                'address' => 'Jl. Pahlawan No. 89, Yogyakarta',
                'phone' => '081567890123',
                'hasPassport' => true,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]
        ];

        DB::table('users')->insert($users);
    }
}
