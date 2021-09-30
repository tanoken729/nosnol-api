<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Like;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class LikeController extends Controller
{
    public function getLikeInfo($user_id, $music_file_id)
    {
        // ユーザーのデータを取得する際にフォローテーブルをjoinさせる
        // $likesCount = User::where('likesed_user_id', $user->id)->get();
        $like_info = DB::table('users')
                        ->where('users.id', '=', $user_id)
                        ->join('likes', 'users.id', '=', 'likes.user_id')
                        ->where('likes.music_file_id', '=', $music_file_id)
                        ->get();
        return response()->json(['likeInfo' => $like_info]);
    }

    public function like(Request $request)
    {
        $likes = new Like;
        $likes->user_id = $request->user_id;
        $likes->music_file_id = $request->music_file_id;
        $likes->save();
    }
    
    public function unlike($user_id, $music_file_id)
    {
        $likes = Like::where('user_id', '=', $user_id)->where('music_file_id', '=', $music_file_id)->first();
        $likes->delete();
        // $likesCount = count(FollowUser::where('likesed_user_id', $user->id)->get());

        // return response()->json(['likesCount' => $likesCount]);
    }
}
