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