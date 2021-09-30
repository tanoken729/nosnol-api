<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
   protected $fillable = ['text', 'user_id', 'music_file_id'];

   public function user()
   {
       return $this->belongsTo('App\User');
   }

   public function item()
   {
       return $this->belongsTo('App\MusicFile');
   }
}