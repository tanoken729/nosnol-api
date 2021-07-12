<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\MusicFile;
use Illuminate\Support\Facades\Storage;

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
        // music_fileにファイル名をつけて保存
        $file_name = $request->file('music_file')->getClientOriginalName();
        $music_file->music_file = Storage::putFileAs('public',$request->music_file, $file_name);
        // cover_imagにファイル名をつけて保存
        $file_name = $request->file('cover_image')->getClientOriginalName();
        $music_file->cover_image = Storage::putFileAs('public',$request->cover_image, $file_name);
        $music_file->title = $request->title;
        $music_file->genre = $request->genre;
        $music_file->emotions = $request->emotions;
        $music_file->user_id = $request->user_id;
        $music_file->save();
    }
}

