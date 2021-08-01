<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MusicFile extends Model
{
    // $fillable = ホワイトリストとして
    protected $fillable = [
        'music_file',
        'cover_image',
        'title',
        'genre',
        'emotions',
        'user_id',
        'user_name',
    ];
}
