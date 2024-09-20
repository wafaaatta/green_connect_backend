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
        'location',
        'status'
    ];

    public function images()
    {
        return $this->hasMany(AnnounceImage::class);
    }
}
