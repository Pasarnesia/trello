<?php

use Illuminate\Http\Request;

Route::group(['prefix'=> 'project', 'as'=> 'project.', 'namespace'=> 'Project',], function(){
    Route::get('/', ['as'=> 'root', 'uses'=> 'ProjectController@index']);
    Route::post('create', ['as'=> 'create', 'uses'=> 'ProjectController@create']);
    Route::group(['prefix'=> '{project_id}'], function(){
        Route::get('/', ['as'=> 'root', 'uses'=> 'ProjectController@getProjectListById']);
    });

    Route::group(['prefix'=> 'list', 'as'=> 'list.',], function(){
        Route::post('/', ['as'=> 'root', 'uses'=> 'ProjectController@getListCard']);
        Route::group(['prefix'=> '{list_id}'], function(){
            Route::put('update', ['as'=> 'update', 'uses'=> 'ProjectController@updateListCard']);
            Route::delete('delete', ['as'=> 'delete', 'uses'=> 'ProjectController@deleteListCard']);
        });
    });
    Route::group(['prefix'=> 'activity', 'as'=> 'activity.',], function(){
        Route::post('/', ['as'=> 'root', 'uses'=> 'ProjectController@getActivityCard']);
        Route::post('description', ['as'=> 'description', 'uses'=> 'ProjectController@updateDescription']);
        Route::group(['prefix'=> '{activity_id}'], function(){
            Route::delete('delete', ['as'=> 'delete', 'uses'=> 'ProjectController@deleteActivityCard']);
        });
    });
});