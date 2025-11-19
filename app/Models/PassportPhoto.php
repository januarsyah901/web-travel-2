<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PassportPhoto extends Model
{
    use HasFactory;

    protected $fillable = ['passport_id', 'file_path'];

    public function passport()
    {
        return $this->belongsTo(Passport::class);
    }
}
