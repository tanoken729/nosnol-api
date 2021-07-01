<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class RegisterController extends Controller
{
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        // モデルからインスタンスを生成
        $user = new User;
        // $requestにformからのデータが格納されているので、以下のようにそれぞれ代入する
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = $request->password;
        // 保存
        $user->save();
    }
}
