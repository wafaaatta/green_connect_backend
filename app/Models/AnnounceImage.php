<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AnnounceImage extends Model
{
    use HasFactory;

    protected $fillable = ['image_url'];

    public function announce()
    {
        return $this->belongsTo(Announce::class);
    }
}
