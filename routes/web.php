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

Auth::routes();

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
