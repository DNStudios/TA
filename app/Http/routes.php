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
	Route::get('authenticate/user','AuthenticateController@getAuthenticatedUser');
});

Route::group(['middleware' => 'cors', 'prefix' => 'api/v1'], function (){
	
	/** Begin Route Post **/
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
	/** End Route Post **/

	/** Begin Route Comment **/
	Route::get('/comments',[
		'uses'	=>	'CommentsController@index',
		'as'	=>	'comment.index'
		]);

	Route::get('/comments/{comments}', [
		'uses'	=>	'CommentsController@show',
		'as'	=>	'comment.show'
		]);

	Route::post('/comments', [
		'uses'	=>	'CommentsController@store',
		'as'	=>	'comment.store'
		]);

	Route::put('/comments/{comments}',[
		'uses'	=>	'CommentsController@update',
		'as'	=>	'comment.update'
		]);

	Route::delete('/comments/{comments}',[
		'uses'	=>	'CommentsController@destroy',
		'as'	=>	'comment.destroy'
		]);

	Route::get('/getCommentsByPost/{postId}',[
		'uses'	=>	'CommentsController@getCommentsByPost',
		'as'	=>	'comment.byPost'
		]);

	Route::get('/getCommentsByUser/{userId}',[
		'uses'	=>	'CommentsController@getCommentsByUser',
		'as'	=>	'comment.byPost'
		]);

	/** End Route Comment **/

	/** Begin Route Tag **/
	Route::get('/tags',[
		'uses'	=>	'TagsController@index',
		'as'	=>	'tag.index'
		]);

	Route::get('/tags/{tags}', [
		'uses'	=>	'TagsController@show',
		'as'	=>	'tag.show'
		]);

	Route::post('/tags', [
		'uses'	=>	'TagsController@store',
		'as'	=>	'tag.store'
		]);

	Route::put('/tags/{tags}',[
		'uses'	=>	'TagsController@update',
		'as'	=>	'tag.update'
		]);

	Route::delete('/tags/{tags}',[
		'uses'	=>	'TagsController@destroy',
		'as'	=>	'tag.destroy'
		]);

	Route::get('/getTagsByPost/{postId}',[
		'uses'	=>	'TagsController@getTagsByPost',
		'as'	=>	'tag.byPost'
		]);

	/** End Route Tag **/

	/** Begin Route category **/
	Route::get('/categories',[
		'uses'	=>	'CategoriesController@index',
		'as'	=>	'category.index'
		]);

	Route::get('/categories/{categories}', [
		'uses'	=>	'CategoriesController@show',
		'as'	=>	'category.show'
		]);

	Route::post('/categories', [
		'uses'	=>	'CategoriesController@store',
		'as'	=>	'category.store'
		]);

	Route::put('/categories/{categories}',[
		'uses'	=>	'CategoriesController@update',
		'as'	=>	'category.update'
		]);

	Route::delete('/categories/{categories}',[
		'uses'	=>	'CategoriesController@destroy',
		'as'	=>	'category.destroy'
		]);

	Route::get('/getCategoriesByPost/{postId}',[
		'uses'	=>	'CategoriesController@getCategoriesByPost',
		'as'	=>	'categories.ByPost'
		]);

	/** End Route category **/

	/** Begin Route group **/
	Route::get('/groups',[
		'uses'	=>	'GroupsController@index',
		'as'	=>	'group.index'
		]);

	Route::get('/groups/{categories}', [
		'uses'	=>	'GroupsController@show',
		'as'	=>	'group.show'
		]);

	Route::post('/groups', [
		'uses'	=>	'GroupsController@store',
		'as'	=>	'group.store'
		]);

	Route::put('/groups/{categories}',[
		'uses'	=>	'GroupsController@update',
		'as'	=>	'group.update'
		]);

	Route::delete('/groups/{categories}',[
		'uses'	=>	'GroupsController@destroy',
		'as'	=>	'group.destroy'
		]);

	Route::get('/getGroupsByUser/{userId}', [
		'uses'	=>	'GroupsController@getGroupsByUser',
		'as'	=>	'group.user'
		]);

	/** End Route group **/
});
