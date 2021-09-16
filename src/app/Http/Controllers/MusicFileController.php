<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\MusicFile;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class MusicFileController extends Controller
{
    public function index()
    {
        $items = MusicFile::all();
        return response()->json(['items' => $items]);
    }

    public function musicFileFilter(Request $request)
    {
        $query = MusicFile::query(); // queryだから且つとかなくても２つのemotion取得且つ、genre取得の場合のデータが取れる？
        if ($request->emotion) {
            $filteredItems = $query->where('emotions', $request->emotion)->get();
        }
        if ($request->genre) {
            $filteredItems = $query->where('genre', $request->genre)->get();
        }
        if ($request->title) {
            $filteredItems = $query->where('title', 'like', "%$request->title%")->get();
        }
        return response()->json(['items' => $filteredItems]);
    }

    public function musicDetailPageData($user_id, $music_file_id, $music_file_user_id)
    {
        $music_detail_page_data = DB::table('music_files')
                        ->where('music_files.id', '=', $music_file_id)
                        ->leftJoin('users', 'users.id', '=', 'music_files.user_id')
                        ->leftJoin('follows', function ($join) use ($user_id){
                            $join->on('users.id', '=', 'follows.followed_id')
                                ->where('follows.following_id', '=', $user_id);
                        })
                        ->leftJoin('likes', function ($join) use ($user_id){
                            $join->on('music_files.id', '=', 'likes.music_file_id')
                                ->where('likes.user_id', '=', $user_id);
                        })
                        ->leftJoin('comments', 'comments.music_file_id', '=', 'music_files.id')
                        ->leftJoin('users as commenter', 'commenter.id', '=', 'comments.user_id')
                        ->select(
                            'follows.followed_id as followed_id',
                            'likes.user_id as likes_user_id',
                            'text',
                            'comments.user_id as comments_user_id',
                            'comments.created_at as comments_created_at',
                            'commenter.name as commenter_name'
                            )
                        ->get();
        return response()->json(['musicDetailPageData' => $music_detail_page_data]);
        // あとでいいね数も取得する
        // $likesCount = count(User::where('followed_user_id', $user->id)->get());
        // return response()->json(['likesCount' => $likesCount]);
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
        $music_file->user_name = $request->user_name;
        $music_file->save();
    }
}

