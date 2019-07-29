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

Route::get('/', function () {
    return view('welcome');
})->name('welcome');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/room', 'HomeController@getRoom')->name('get.room');
Route::get('/agenda', 'HomeController@getAgenda')->name('get.agenda');

Route::post('/room', 'HomeController@addRoom')->name('post.add.room');
