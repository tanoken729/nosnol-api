<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\CreateUserRequest;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    public function musicDetailPageData($user_id, $music_file_id, $music_file_user_id)
    {
        // ユーザーのデータを取得する際にフォローテーブルをjoinさせる
        // $followCount = User::where('followed_user_id', $user->id)->get();
        $music_detail_page_data = DB::table('users')
                        ->where('users.id', '=', $user_id)
                        ->join('follows', 'users.id', '=', 'follows.following_id')
                        ->where('follows.followed_id', '=', $music_file_user_id)
                        ->join('likes', 'users.id', '=', 'likes.user_id')
                        ->where('likes.music_file_id', '=', $music_file_id)
                        ->join('comments', 'users.id', '=', 'comments.user_id')
                        ->where('comments.music_file_id', '=', $music_file_id)
                        ->get();
        return response()->json(['musicDetailPageData' => $music_detail_page_data]);
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(CreateUserRequest $request)
    {
        // モデルからインスタンスを生成
        $user = new User;
        // $requestにformからのデータが格納されているので、以下のようにそれぞれ代入する
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        // 保存
        $user->save();
    }
}