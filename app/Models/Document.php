<?php

namespace App\Models;

use App\Traits\LogsActivity;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Document extends Model
{
    use HasFactory, LogsActivity;

    protected $fillable = ['user_id', 'ktp', 'kk', 'dokumen_pendukung'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
