<?php

use Illuminate\Support\Facades\Route;

/*   */

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

Auth::routes();

Route::prefix('admin')
    ->namespace('Admin')
    ->middleware('auth')
    ->group(function () {
        Route::get('home', 'HomeController@index')->name('home');
        Route::resource('posts', 'PostController');
    });

/* guest */
/* Route::get('/', function () {
return view('guests.home');
})->name('guestHome'); */
Route::view('/', 'guests.home')->name('guestHome');

Route::get('posts', 'PostController@index')->name('guest.posts.home');
Route::get('posts/show/{slug}', 'PostController@show')->name('guest.posts.show');

/* oppure */
/* Route::get('admin/home', 'Admin\HomeController@index')->name('home'); */
