<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\HomeController;

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

Route::group(['middleware' => 'localization'], function () {
    Route::get('change-language/{language}', [HomeController::class, 'changeLanguage'])
        ->name('change-language');
    
    Route::redirect('/', '/home');

    Auth::routes();

    Route::resource('stories', 'StoryController')->except(['index']);

    Route::get('/home', 'HomeController@index')->name('home');

    Route::group(['prefix' => 'admin'], function () {
        Route::resource('users', UserController::class)->names([
            'create' => 'create_user',
            'store' => 'store_user',
            'index' => 'list_user',
            'edit' => 'edit_user',
            'update' => 'update_user',
            'show' => 'read_user',
        ]);
    });

    // route for profile feature
    Route::get('profile', 'HomeController@viewProfile')->name('profile');
    Route::get('/edit-profile', 'HomeController@editProfile')->name('edit-profile');
    Route::put('/edit-profile', 'HomeController@updateProfile')->name('edit-profile');

    Route::get('following', 'FollowController@listFollowing')->name('follow.following');
    Route::get('follower', 'FollowController@listFollower')->name('follow.follower');
    Route::middleware(['auth'])->group(function () {
        Route::post('following/{id}', 'FollowController@follow')->name('follow.add');
        Route::delete('follower/{id}', 'FollowController@destroy')->name('follow.destroy');
    });

    Route::resource('comments', 'CommentController')->only(['store', 'update', 'destroy']);
});
