<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MusicFile extends Model
{
    protected $fillable = [
        'music_file',
        'cover_image',
        'title',
        'genre',
        'emotions',
        'user_id',
    ];
}
