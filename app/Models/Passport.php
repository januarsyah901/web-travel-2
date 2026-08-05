<?php

namespace App\Models;

use App\Traits\LogsActivity;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Passport extends Model
{
    use HasFactory, LogsActivity;

    protected $fillable = ['user_id', 'passportName', 'isActive'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function passportPhotos()
    {
        return $this->hasMany(PassportPhoto::class);
    }
}
