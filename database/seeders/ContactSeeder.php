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
            'address' => 'Jl. Sidotopo Wetan Baru Gg. 2 No. 36, Surabaya, Jawa Timur',
            'phone' => '031-12345678',
            'phone_2' => '031-87654321',
            'whatsapp' => '082133087492',
            'email' => 'info@fabiabadi.com',
            'email_2' => 'cs@fabiabadi.com',
            'facebook' => 'https://facebook.com/fabiabadi',
            'instagram' => 'https://instagram.com/fabiabadi',
            'twitter' => 'https://twitter.com/fabiabadi',
            'youtube' => 'https://youtube.com/@fabiabadi',
            'tiktok' => 'https://tiktok.com/@fabiabadi',
            'working_hours' => 'Senin - Sabtu: 08.00 - 16.30 WIB
Minggu & Tanggal Merah: Libur',
            'maps_embed' => '<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d4957.786747463162!2d112.7345165!3d-7.2427049!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2dd7f93ea2be191f%3A0xc6d61bdf3074d193!2sFABI%20ABADI%20UMRAH%20%26%20HAJI%20PLUS%2C%20Tour%20%26%20Travel!5e1!3m2!1sen!2sid!4v1768120701310!5m2!1sen!2sid" width="600" height="450" style="border:0; border-radius: 0.75rem;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>',
            'is_active' => true,
        ]);
    }
}
