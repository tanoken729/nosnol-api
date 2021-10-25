<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
// デフォルト
Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

// テスト
Route::get('test', function() {
    return response()->json(['name' => '山田太郎', 'gender' => '男','mail' => 'yamada@test.com']);
});

// ログイン
Route::prefix('v1')->group(function(){
    Route::group(['middleware' => 'api', 'prefix' => 'auth'], function ($router) {
        Route::post('login', 'AuthController@login')->name('login');
        Route::post('logout', 'AuthController@logout');
        Route::post('refresh', 'AuthController@refresh');
        Route::get('me', 'AuthController@me');
    });
});

Route::group(["middleware" => "api"], function () {
    // 新規登録
    Route::post('/register', 'RegisterController@create');

    // トップページの音楽ファイル取得
    Route::get('/musicFileData', 'MusicFileController@index');

    // 音楽ファイルアップロード
    Route::post('/musicFileUpload', 'MusicFileController@musicFileUpload');

    // フォロー
    Route::get('{followed_id}/{following_id}/getFollowInfo', 'FollowController@getFollowInfo');
    Route::post('/follow', 'FollowController@follow');
    Route::get('{followed_id}/{following_id}/unfollow', 'FollowController@unfollow');

    // いいね
    Route::get('{user_id}/{music_file_id}/getLikeInfo', 'LikeController@getLikeInfo');
    Route::post('/like', 'LikeController@like');
    Route::get('{user_id}/{music_file_id}/unlike', 'LikeController@unlike');

    // コメント
    Route::get('{user_id}/{music_file_id}/getCommentInfo', 'CommentController@getCommentInfo');
    Route::post('/comment', 'CommentController@comment');
    Route::get('{user_id}/{music_file_id}/uncomment', 'CommentController@uncomment');

    // ファイル詳細画面の情報取得
    Route::get('{user_id}/{music_file_id}/{music_file_user_id}/musicDetailPageData', 'MusicFileController@musicDetailPageData');
    // ユーザー詳細画面の情報取得
    Route::get('{user_id}/userDetailPageData', 'RegisterController@userDetailPageData');

    // 感情・ジャンル絞り込み、ファイル名検索（クエリパラメータで取得）
    Route::get('musicFileFilter/emotion/genre/title', 'MusicFileController@musicFileFilter');

    // ログインユーザープロフィール編集画面の情報取得
    Route::get('loginUserProfileData/{user_id}', 'RegisterController@getLoginUserProfileData');
    // ログインユーザープロフィール更新（Routeにはputが提供されていないためpostでリクエストを行う）
    Route::post('loginUserProfileData/{user_id}', 'RegisterController@updateLoginUserProfileData');
});