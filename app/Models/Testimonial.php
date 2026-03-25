<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Testimonial extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'user_id', 'content', 'rating', 'author_photo', 'review_url', 'review_time'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
