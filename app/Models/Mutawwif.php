<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mutawwif extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'description', 'photo_path'];
}
