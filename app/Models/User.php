<?php

namespace App\Models;

use App\Traits\LogsActivity;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable, LogsActivity;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'fullName',
        'birthDate',
        'address',
        'phone',
        'hasPassport',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'password' => 'hashed',
            'birthDate' => 'date',
            'hasPassport' => 'boolean',
        ];
    }

    public function bookings()
    {
        return $this->hasMany(Booking::class);
    }

    public function documents()
    {
        return $this->hasOne(Document::class);
    }

    public function passports()
    {
        return $this->hasMany(Passport::class);
    }

    public function passport()
    {
        return $this->hasOne(Passport::class)->latestOfMany();
    }

    public function testimonials()
    {
        return $this->hasMany(Testimonial::class);
    }

    protected function phone(): Attribute
    {
        return Attribute::make(
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
}
