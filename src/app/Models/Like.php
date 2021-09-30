<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Like extends Model
{
    protected $fillable = [
        'user_id',
        'music_file_id',
    ];

    // public function musicFile()
    // {
    //   return $this->belongsToMany('App\MusicFile');
    // }
  
    // public function user()
    // {
    //   return $this->belongsToMany('App\User');
    // }
}
