<?php

use Illuminate\Http\Request;

Route::group(['prefix'=> 'project', 'as'=> 'project.', 'namespace'=> 'Project',], function(){
    Route::get('/', ['as'=> 'root', 'uses'=> 'ProjectController@index']);
    Route::post('create', ['as'=> 'create', 'uses'=> 'ProjectController@create']);
    Route::group(['prefix'=> 'activity', 'as'=> 'activity.',], function(){
        Route::post('description', ['as'=> 'description', 'uses'=> 'ProjectController@updateDescription']);
    });        
});