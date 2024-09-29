<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    use HasFactory;

    protected $fillable = [
        'content',
        'sender_id',
        'receiver_id',
        'conversation_id',
        'reply_message_id',
    ];

    public function conversation()
    {
        return $this->belongsTo(Conversation::class);
    }

    public function reply_message()
    {
        return $this->belongsTo(Message::class, 'reply_message_id');
    }
}