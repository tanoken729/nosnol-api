<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\MusicFile;
use Illuminate\Support\Facades\Storage;

class MusicFileController extends Controller
{
    public function index()
    {
        return MusicFile::all();
    }
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
        $include_public = Storage::putFileAs('public/mp3files', $request->file('music_file'), $file_name);
        $music_file->music_file = str_replace('public/', '', $include_public);
        
        // cover_imagにファイル名をつけて保存
        $file_name = $request->file('cover_image')->getClientOriginalName();
        $include_public = Storage::putFileAs('public/images', $request->file('cover_image'), $file_name);
        $music_file->cover_image = str_replace('public/', '', $include_public);

        $music_file->title = $request->title;
        $music_file->genre = $request->genre;
        $music_file->emotions = $request->emotions;
        $music_file->user_id = $request->user_id;
        $music_file->save();
    }
}

