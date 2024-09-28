<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Conversation extends Model
{
    use HasFactory;

    protected $fillable = ['creator_id', 'receiver_id', 'announce_id'];

    protected $casts = [
        "receiver_id" => "integer",
        "creator_id" => "integer",
        "announce_id" => "integer",
    ];

    public function messages()
    {
        return $this->hasMany(Message::class);
    }

    public function announce()
    {
        return $this->belongsTo(Announce::class);
    }

    public function creator()
    {
        return $this->belongsTo(User::class, 'creator_id');
    }

    public function receiver()
    {
        return $this->belongsTo(User::class, 'receiver_id');
    }
}