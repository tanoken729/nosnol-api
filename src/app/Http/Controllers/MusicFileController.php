<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\MusicFile;

class MusicFileController extends Controller
{
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function musicFileUpload(Request $request)
    {
        $music_file = new MusicFile;
        $music_file->music_file = $request->music_file;
        $music_file->cover_image = $request->cover_image;
        $music_file->title = $request->title;
        $music_file->genre = $request->genre;
        $music_file->emotions = $request->emotions;
        $music_file->user_id = $request->user_id;
        $music_file->save();
    }
}

