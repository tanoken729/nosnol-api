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

Route::get('test', function() {
    return response()->json(['name' => '山田太郎', 'gender' => '男','mail' => 'yamada@test.com']);
});

Route::prefix('v1')->group(function(){
    Route::group(['middleware' => 'api', 'prefix' => 'auth'], function ($router) {
        Route::post('login', 'AuthController@login')->name('login');
        Route::post('logout', 'AuthController@logout');
        Route::post('refresh', 'AuthController@refresh');
        Route::get('me', 'AuthController@me');
    });
});

// createメソッドを実行
Route::group(["middleware" => "api"], function () {
    Route::post('/register', 'RegisterController@create'); // 追加
    Route::get('/musicFileData', 'MusicFileController@index');
    Route::post('/musicFileUpload', 'MusicFileController@musicFileUpload'); // 追加
    Route::get('{followed_id}/{following_id}/getFollowInfo', 'FollowController@getFollowInfo');
    Route::post('/follow', 'FollowController@follow');
    Route::get('{followed_id}/{following_id}/unfollow', 'FollowController@unfollow');
    
    Route::get('{user_id}/{music_file_id}/getLikeInfo', 'LikeController@getLikeInfo');
    Route::post('/like', 'LikeController@like');
    Route::get('{user_id}/{music_file_id}/unlike', 'LikeController@unlike');

    Route::get('{user_id}/{music_file_id}/getCommentInfo', 'CommentController@getCommentInfo');
    Route::post('/comment', 'CommentController@comment');
    Route::get('{user_id}/{music_file_id}/uncomment', 'CommentController@uncomment');
    Route::get('{user_id}/{music_file_id}/{music_file_user_id}/musicDetailPageData', 'MusicFileController@musicDetailPageData');
    // Route::group(['middleware' => ['jwt.auth']], function () {
    // });
});