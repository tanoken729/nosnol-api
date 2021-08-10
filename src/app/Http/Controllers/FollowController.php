<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Follow;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class FollowController extends Controller
{
    public function getFollowInfo($user_id)
    {
        // ユーザーのデータを取得する際にフォローテーブルをjoinさせる
        // $followCount = User::where('followed_user_id', $user->id)->get();
        $follow_info = DB::table('users')
                        ->where('users.id', '=', $user_id)
                        ->join('follows', 'users.id', '=', 'follows.following_id')
                        ->get();
        return response()->json(['followInfo' => $follow_info]);
    }

    public function follow(Request $request)
    {
        $follows = new Follow;
        $follows->following_id = $request->following_id;
        $follows->followed_id = $request->followed_id;
        $follows->save();
    }
    
    public function unfollow($followed_id, $following_id)
    {
        $follow = Follow::where('following_id', '=', $following_id)->where('followed_id', '=', $followed_id)->first();
        $follow->delete();
        // $followCount = count(FollowUser::where('followed_user_id', $user->id)->get());

        // return response()->json(['followCount' => $followCount]);
    }
}
