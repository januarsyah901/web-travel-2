<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    protected $fillable = [
        'company_name',
        'address',
        'phone',
        'phone_2',
        'whatsapp',
        'email',
        'email_2',
        'facebook',
        'instagram',
        'twitter',
        'youtube',
        'tiktok',
        'working_hours',
        'maps_embed',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    // Scope untuk kontak aktif
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    // Method untuk mendapatkan kontak utama (yang pertama dan aktif)
    public static function getMainContact()
    {
        return self::active()->first();
    }

    // Method untuk format nomor WhatsApp
    public function getWhatsappLinkAttribute()
    {
        $phone = preg_replace('/[^0-9]/', '', $this->whatsapp);
        if (substr($phone, 0, 1) === '0') {
            $phone = '62' . substr($phone, 1);
        }
        return "https://wa.me/{$phone}";
    }

    // Method untuk mendapatkan social media links
    public function getSocialMediaAttribute()
    {
        return [
            'facebook' => $this->facebook,
            'instagram' => $this->instagram,
            'twitter' => $this->twitter,
            'youtube' => $this->youtube,
            'tiktok' => $this->tiktok,
        ];
    }
}
