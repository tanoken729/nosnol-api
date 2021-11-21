<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\CreateUserRequest;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

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
                        ->leftJoin('music_files', 'music_files.user_id', '=', 'users.id')
                        ->select(
                            'music_files.title',
                            'music_files.cover_image',
                            'music_files.music_file',
                            'music_files.user_id',
                            'music_files.id',
                            // music_filesにusersをjoinさせてuser_nameを取得
                            'users.name as user_name',
                            'users.user_icon',
                            'users.description'
                            )
                        ->get();
        return response()->json(['userDetailItems' => $user_detail_page_data]);
    }

    public function getLoginUserProfileData($user_id)
    {
        $login_user_profile_page_data = DB::table('users')
                        ->where('users.id', '=', $user_id)
                        ->get();
        return response()->json(['loginUserProfileItems' => $login_user_profile_page_data]);
    }

    public function updateLoginUserProfileData(Request $request,$user_id)
    {
        $user = User::find($user_id);
        $user->name = $request->name;
        $user->email = $request->email;

        // user_iconの変更リクエストがあった場合は更新
            // Storageに保存する場合
            if ($request->file('user_icon')) {
                $file_name = $request->file('user_icon')->getClientOriginalName();
                $include_public = Storage::putFileAs('public/userIcons', $request->file('user_icon'), $file_name);
                $user->user_icon = str_replace('public/', '', $include_public);
            }
            // s3に保存する場合
            // if ($request->file('user_icon')) {
            //     $file_name = $request->file('user_icon')->getClientOriginalName();
            //     $user->user_icon = Storage::disk('s3')->putFileAs('userIcons', $request->file('user_icon'), $file_name, 'public');
            // }

        // 自己紹介の入力があった場合は更新する
        if ($request->description) {
            $user->description = $request->description;
        } else { // 入力がない場合は空文字を保存する（フロント側で取得した時nullがテキストボックスに表示されてしまうため）
            $user->description = ' ';
        }
        // パスワードの入力があった場合は更新する
        if ($request->password) {
            $user->password = Hash::make($request->password);
        }
        $user->save();
    }

    public function destroy(Request $request)
    {
        // 対象モデル取得
        $music_file = User::find($request->id);
        $music_file->delete();
    }
}