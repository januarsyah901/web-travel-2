<?php

namespace App\Models;

use App\Traits\LogsActivity;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Package extends Model
{
    use HasFactory, LogsActivity;

    protected $fillable = [
        'title',
        'schedule',
        'duration',
        'price',
        'description',
        'hotel_makkah',
        'hotel_madinah',
    ];

    // Legacy blade sometimes uses $package->name
    public function getNameAttribute(): string
    {
        return (string) ($this->attributes['title'] ?? '');
    }

    protected function casts(): array
    {
        return [
            'price' => 'decimal:2',
        ];
    }

    public function bookings()
    {
        return $this->hasMany(Booking::class);
    }
}
