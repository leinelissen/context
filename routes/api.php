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

Route::group(['middleware' => 'auth:api'], function () {
    Route::resource('message', 'MessageController');
    Route::resource('channel', 'ChannelController');
    Route::get('users/{query}', 'UserController@find');
    Route::get('user/{id}', 'UserController@show');
    Route::get('read/{id}', 'MessageController@read');
    Route::post('announce/{id}', 'ChannelController@announce');
});
