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
Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
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
    Route::get('/musicFileList', 'MusicFileController@index');

    // 音楽ファイルアップロード
    Route::post('/musicFile', 'MusicFileController@musicFileUpload');

    // フォロー（フォローアクション時）
    Route::get('/followInfo/{followed_id}/{following_id}', 'FollowController@getFollowInfo');
    Route::post('/follow', 'FollowController@follow');
    Route::get('/unfollow/{followed_id}/{following_id}', 'FollowController@unfollow');

    // いいね（いいねアクション時）
    Route::get('/likeInfo/{user_id}/{music_file_id}', 'LikeController@getLikeInfo');
    Route::post('/like', 'LikeController@like');
    Route::get('/unlike/{user_id}/{music_file_id}', 'LikeController@unlike');

    // コメント（コメントアクション時）
    Route::get('/commentInfo/{music_file_id}', 'CommentController@getCommentInfo');
    Route::post('/comment', 'CommentController@comment');
    Route::get('/uncomment/{user_id}/{music_file_id}', 'CommentController@uncomment');

    // ファイル詳細画面の情報取得（ファイル詳細初期表示時に実行される）
    Route::get('musicDetailPageData/{user_id}/{music_file_id}/{music_file_user_id}', 'MusicFileController@musicDetailPageData');
    // ユーザー詳細画面の情報取得
    Route::get('userDetailPageData/{user_id}', 'RegisterController@userDetailPageData');

    // ファイルタイトル検索、感情・ジャンル絞り込み（クエリパラメータで取得）
    Route::get('searchMusicFile/emotion/genre/title', 'MusicFileController@musicFileFilter');

    // ログインユーザープロフィール編集画面の情報取得
    Route::get('loginUserProfileData/{user_id}', 'RegisterController@getLoginUserProfileData');
    // ログインユーザープロフィール更新（Routeにはputが提供されていないためpostでリクエストを行う）
    Route::post('loginUserProfileData/{user_id}', 'RegisterController@updateLoginUserProfileData');

    // 音楽ファイル削除
    Route::post('deleteMusicfile', 'MusicFileController@musicFileDestroy');

    // 退会
    Route::post('deleteUser', 'RegisterController@destroy');
});