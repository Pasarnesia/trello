<?php

use Illuminate\Http\Request;

Route::group(['prefix'=> 'project', 'as'=> 'project.', 'namespace'=> 'Project',], function(){
    Route::get('/', ['as'=> 'root', 'uses'=> 'ProjectController@index']);
    Route::post('create', ['as'=> 'create', 'uses'=> 'ProjectController@create']);
    Route::group(['prefix'=> '{project_id}'], function(){
        Route::get('/', ['as'=> 'root', 'uses'=> 'ProjectController@getProjectListById']);
        Route::put('update', ['as'=> 'update', 'uses'=> 'ProjectController@updateProject']);
        Route::delete('delete', ['as'=> 'delete', 'uses'=> 'ProjectController@deleteProject']);
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

    Route::group(['prefix'=> 'checklist', 'as'=> 'checklist.',], function(){
        Route::post('/', ['as'=> 'root', 'uses'=> 'ProjectController@getChecklistCard']);
        Route::post('create', ['as'=> 'create', 'uses'=> 'ProjectController@createChecklist']);
        Route::group(['prefix'=> '{Checklist_id}'], function(){
            Route::put('update', ['as'=> 'update', 'uses'=> 'ProjectController@updateChecklist']);
            Route::delete('delete', ['as'=> 'delete', 'uses'=> 'ProjectController@deleteChecklist']);
        });
    });

    Route::group(['prefix'=> 'chat', 'as'=> 'chat.',], function(){
        Route::get('get', ['as'=> 'get', 'uses'=> 'ProjectController@getChat']);
        Route::post('create', ['as'=> 'description', 'uses'=> 'ProjectController@createChat']);
        Route::group(['prefix'=> '{chat_id}'], function(){
            Route::put('update', ['as'=> 'update', 'uses'=> 'ProjectController@updateChat']);
            Route::delete('delete', ['as'=> 'delete', 'uses'=> 'ProjectController@deleteChat']);
        });
    });

    Route::group(['prefix'=> 'transaction', 'as'=> 'transaction.',], function(){
        Route::get('get', ['uses'=> 'ProjectController@getTransaction']);
        Route::post('create', ['uses'=> 'ProjectController@createTransaction']);
    });

    Route::group(['prefix'=> 'media', 'as'=> 'media.',], function(){
        Route::post('upload', ['as'=> 'upload', 'uses'=> 'ProjectController@uploadMedia']);
    });

});