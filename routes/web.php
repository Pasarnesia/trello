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
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/projects/{project_id}', 'HomeController@projectView')->name('projectView');
Route::get('/projects', 'HomeController@projectMenu')->name('projectMenu');
Route::get('/chats', 'HomeController@chatMenu')->name('chatMenu');
Route::get('/settings', 'HomeController@settingMenu')->name('settingMenu');
