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
        $items = MusicFile::leftJoin('users', 'users.id', '=', 'music_files.user_id')
        ->select(
            'music_files.title',
            'music_files.cover_image',
            'music_files.music_file',
            'music_files.user_id',
            'music_files.id',
            // music_filesにusersをjoinさせてuser_nameを取得
            'users.name as user_name',
            'users.description'
            )
        ->get();
        return response()->json(['items' => $items]);
    }

    public function musicFileFilter(Request $request)
    {
        // userをjoinさせる？
        $query = MusicFile::query(); // queryだから且つとかなくても２つのemotion取得且つ、genre取得の場合のデータが取れる？
        if ($request->emotion) {
            $filteredItems = $query->where('emotions', $request->emotion)
            ->leftJoin('users', 'users.id', '=', 'music_files.user_id')
            ->select(
                'music_files.title',
                'music_files.cover_image',
                'music_files.music_file',
                'music_files.user_id',
                'music_files.id',
                // music_filesにusersをjoinさせてuser_nameを取得
                'users.name as user_name',
                'users.description'
                )
            ->get();
        }
        if ($request->genre) {
            $filteredItems = $query->where('genre', $request->genre)
            ->leftJoin('users', 'users.id', '=', 'music_files.user_id')
            ->select(
                'music_files.title',
                'music_files.cover_image',
                'music_files.music_file',
                'music_files.user_id',
                'music_files.id',
                // music_filesにusersをjoinさせてuser_nameを取得
                'users.name as user_name',
                'users.description'
                )
            ->get();
        }
        if ($request->has('title')) {
            $filteredItems = $query->where('title', 'like', "%$request->title%")
            ->leftJoin('users', 'users.id', '=', 'music_files.user_id')
            ->select(
                'music_files.title',
                'music_files.cover_image',
                'music_files.music_file',
                'music_files.user_id',
                'music_files.id',
                // music_filesにusersをjoinさせてuser_nameを取得
                'users.name as user_name',
                'users.description'
                )
            ->get();
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

        // リクエストされてきたmusic_fileに元々ついていたファイル名をつけて保存
        $file_name = $request->file('music_file')->getClientOriginalName();
        // Storageに保存する場合
            // public/mp3files配下に保存
            // $include_public = Storage::putFileAs('public/mp3files', $request->file('music_file'), $file_name);
            // public/部分をカット
            // $music_file->music_file = str_replace('public/', '', $include_public);
        // s3に保存する場合
        $music_file->music_file = Storage::disk('s3')->putFileAs('musicFiles', $request->file('music_file'), $file_name, 'public');
        
        // リクエストされてきたcover_imagにファイル名をつけて保存
        // 元々ついていたファイル名を保存するファイル名に設定
        $file_name = $request->file('cover_image')->getClientOriginalName();
        // Storageに保存する場合
            // public/images配下に保存
            // $include_public = Storage::putFileAs('public/images', $request->file('cover_image'), $file_name);
            // public/部分をカット
            // $music_file->cover_image = str_replace('public/', '', $include_public);
        // s3に保存する場合
        $music_file->cover_image = Storage::disk('s3')->putFileAs('images', $request->file('cover_image'), $file_name, 'public');

        $music_file->title = $request->title;
        $music_file->genre = $request->genre;
        $music_file->emotions = $request->emotions;
        $music_file->user_id = $request->user_id;
        $music_file->save();
    }
}
