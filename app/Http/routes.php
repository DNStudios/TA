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

Route::group(['middleware' => 'cors', 'prefix' => 'api'], function (){
	Route::resource('authenticate','AuthenticateController',['only'=>['index']]);
	Route::post('authenticate','AuthenticateController@authenticate');
	Route::get('authenticate/user','AuthenticateController@AuthenticatedUser');
});

Route::group(['middleware' => 'cors', 'prefix' => 'api/v1'], function (){
	
	Route::get('/posts',[
		'uses'	=>	'PostsController@index',
		'as'	=>	'post.index'
		]);

	Route::get('/posts/{posts}', [
		'uses'	=>	'PostsController@show',
		'as'	=>	'post.show'
		]);

	Route::post('/posts', [
		'uses'	=>	'PostsController@store',
		'as'	=>	'post.store'
		]);

	Route::put('/posts/{posts}',[
		'uses'	=>	'PostsController@update',
		'as'	=>	'post.update'
		]);

	Route::delete('/posts/{posts}',[
		'uses'	=>	'PostsController@destroy',
		'as'	=>	'post.destroy'
		]);
});
