<?php

namespace App\Models;

use App\Traits\LogsActivity;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mutawwif extends Model
{
    use HasFactory, LogsActivity;

    protected $fillable = ['name', 'specialization', 'photo_path'];
}
