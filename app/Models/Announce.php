<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Announce extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'country',
        'city',
        'postal_code',
        'status',
        'image',
        'user_id',
        'category',
        'request_type',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    
    public function conversations()
    {
        return $this->hasMany(Conversation::class);
    }
}