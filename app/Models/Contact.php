<?php

namespace App\Models;

use App\Traits\LogsActivity;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    use LogsActivity;

    public const OFFICE_PHONE = '031-12345678';

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
        'linkedin',
        'pinterest',
        'telegram',
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

    protected function whatsapp(): Attribute
    {
        return Attribute::make(
            get: fn (?string $value) => self::normalizeWhatsapp($value),
            set: fn (?string $value) => self::normalizeWhatsapp($value),
        );
    }

    public static function normalizeWhatsapp(?string $value): ?string
    {
        if ($value === null || $value === '') {
            return $value;
        }

        $digits = preg_replace('/\D+/', '', $value);
        if ($digits === '') {
            return $value;
        }

        if (str_starts_with($digits, '0')) {
            return '62' . substr($digits, 1);
        }

        return $digits;
    }

    public function getWhatsappLinkAttribute()
    {
        $phone = self::normalizeWhatsapp($this->whatsapp) ?? '';
        return $phone !== '' ? "https://wa.me/{$phone}" : '#';
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
            'linkedin' => $this->linkedin,
            'pinterest' => $this->pinterest,
            'telegram' => $this->telegram,
        ];
    }

    // Method untuk mendapatkan semua social media yang aktif (bukan null)
    public function getActiveSocialMediaAttribute()
    {
        $socials = $this->social_media;
        return array_filter($socials, function ($value) {
            return !is_null($value);
        });
    }
}
