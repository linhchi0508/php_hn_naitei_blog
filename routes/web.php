<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('welcome');
});
Route::get('following', 'FollowController@ListFollowing')->name('follow.following');
Route::post('following/{id}', 'FollowController@follow')->name('follow.add');
Route::delete('follower/{id}','FollowController@destroy')->name('follow.destroy');
Route::get('follower', 'FollowController@ListFollower')->name('follow.follower');
