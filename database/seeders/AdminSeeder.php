<?php

namespace Database\Seeders;

use App\Models\Admin;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class AdminSeeder extends Seeder
{
    use WithoutModelEvents;

    public function run(): void
    {
        Admin::updateOrCreate(
            ['email' => 'januarsyahakbar791@gmail.com'],
            [
                'name' => 'Januarsyah Akbar',
                // unusable password — login Google only
                'password' => Str::password(32),
                'role' => 'superadmin',
            ]
        );
    }
}
