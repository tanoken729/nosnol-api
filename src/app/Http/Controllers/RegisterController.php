<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\CreateUserRequest;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
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
    public function userDetailPageData($user_id)
    {
        // ユーザーの音声ファイルとフォロー情報
        // $followCount = User::where('followed_user_id', $user->id)->get();
        $user_detail_page_data = DB::table('users')
                        ->where('users.id', '=', $user_id)
                        ->join('music_files', 'music_files.user_id', '=', 'users.id')
                        ->get();
        return response()->json(['userDetailItems' => $user_detail_page_data]);
    }
}