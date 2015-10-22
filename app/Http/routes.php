<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::post('oauth/access_token', function() {
    return Response::json(Authorizer::issueAccessToken());
});

Route::group( ['middleware'=>'oauth'], function() {
    //Route::ressource busca todos os metodos padroes do laravel, aí não precisa criar rotas individuais para
    //update,destroy,show,index,store
    Route::resource('client', 'ClientController', ['except'=>['create','edit']]);

    Route::resource('project','ProjectController', ['except'=>['create','edit']]);

    Route::resource('project/{id}/note','ProjectNoteController', ['except'=>['create','edit']]);
    Route::resource('project/{id}/task','ProjectTaskController', ['except'=>['create','edit']]);

/*    Route::group( ['prefix' => 'project'], function() {
        Route::resource('{id}/note','ProjectNoteController', ['except'=>['create','edit']]);
        Route::resource('{id}/task','ProjectTaskController', ['except'=>['create','edit']]);
    });
*/
});

/*

    Route::get('client', 'ClientController@index');
    Route::post('client', 'ClientController@store');
    Route::get('client/{id}', 'ClientController@show');
    Route::delete('client/{id}', 'ClientController@destroy');
    Route::put('client/{id}', 'ClientController@update');

    Route::get('project', 'ProjectController@index');
    Route::post('project', 'ProjectController@store');
    Route::get('project/{id}', 'ProjectController@show');
    Route::delete('project/{id}', 'ProjectController@destroy');
    Route::put('project/{id}', 'ProjectController@update');

    Route::get('projecttask', 'ProjectTaskController@index');
    Route::post('projecttask', 'ProjectTaskController@store');
    Route::get('projecttask/{id}', 'ProjectTaskController@show');
    Route::delete('projecttask/{id}', 'ProjectTaskController@destroy');
    Route::put('projecttask/{id}', 'ProjectTaskController@update');

    Route::get('projectnote', 'ProjectNoteController@index');
    Route::post('projectnote', 'ProjectNoteController@store');
    Route::get('projectnote/{id}', 'ProjectNoteController@show');
    Route::delete('projectnote/{id}', 'ProjectNoteController@destroy');
    Route::put('projectnote/{id}', 'ProjectNoteController@update');

    Route::get('/project/{id}/members', 'ProjectController@isMember');
*/
