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

Route::group(['prefix' => '/', 'as' => 'root',], function(){
    Route::get('home', 'HomeController@index')->name('home');
    Route::get('team', 'HomeController@team')->name('team');

    Route::group(['prefix' => 'projects', 'as' => 'projects',], function(){
        Route::get('/', 'HomeController@projectMenu')->name('projectMenu');
        Route::post('/', 'HomeController@createProject')->name('createProject');
        Route::get('{project_id}', 'HomeController@projectView')->name('projectView');
    });

    Route::group(['prefix' => 'lists', 'as' => 'lists',], function(){
        Route::post('/', 'HomeController@createList')->name('createList');
    });

    Route::group(['prefix' => 'cards', 'as' => 'cards',], function(){
        Route::post('/', 'HomeController@createCard')->name('createCard');
    });

    // Route::group(['prefix' => 'cards', 'as' => 'cards',], function(){
    //     Route::post('/', 'HomeController@createCard')->name('createCard');
    // });

    Route::group(['prefix' => 'chats', 'as' => 'chats',], function(){
        Route::get('/', 'HomeController@chatMenu')->name('chatMenu');
        Route::get('{project_id}', 'HomeController@chatProject')->name('chatProject');
    });


    Route::get('settings', 'HomeController@settingMenu')->name('settingMenu');
});
