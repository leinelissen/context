<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::group(['middleware' => 'auth'], function () {
    Route::get('/', 'BootstrapController@getChannels')->name('home');
    Route::get('/channel/{id}', 'BootstrapController@getChannel')->middleware('ownedByUser');
});

Route::group(['namespace' => 'Auth', 'prefix' => 'auth'], function () {
    Route::get('login', 'LoginController@showLoginForm')->name('login');
    Route::post('login', 'LoginController@login');
    Route::get('logout', 'LoginController@logout')->name('logout');
    Route::get('register', 'RegisterController@showRegistrationForm')->name('register');
    Route::post('register', 'RegisterController@register');
    Route::get('token/{token}', 'LoginController@authenticateToken');
});
