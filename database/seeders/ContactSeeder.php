<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Contact;

class ContactSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Contact::create([
            'company_name' => 'PT Fabi Abadi',
            'address' => 'Jl. Raya Umroh No. 123, Jakarta Selatan, DKI Jakarta 12345',
            'phone' => '021-12345678',
            'phone_2' => '021-87654321',
            'whatsapp' => '081234567890',
            'email' => 'info@fabiabadi.com',
            'email_2' => 'cs@fabiabadi.com',
            'facebook' => 'https://facebook.com/fabiabadi',
            'instagram' => 'https://instagram.com/fabiabadi',
            'twitter' => 'https://twitter.com/fabiabadi',
            'youtube' => 'https://youtube.com/@fabiabadi',
            'tiktok' => 'https://tiktok.com/@fabiabadi',
            'working_hours' => 'Senin - Jumat: 08:00 - 17:00 WIB
Sabtu: 08:00 - 14:00 WIB
Minggu & Tanggal Merah: Libur',
            'maps_embed' => '<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3966.0!2d106.8!3d-6.2!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x0!2zNsKwMTInMDAuMCJTIDEwNsKwNDgnMDAuMCJF!5e0!3m2!1sen!2sid!4v1234567890" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy"></iframe>',
            'is_active' => true,
        ]);
    }
}
