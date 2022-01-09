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

	use Illuminate\Support\Facades\Route;

	Route::get('admin/user_list', ['as' => 'admin.user_list', 'middleware' => 'auth:admin', 'uses' => 'UserController@user_list']);
	Route::get('admin/tag_list', ['as' => 'admin.tag_list', 'middleware' => 'auth:admin', 'uses' => 'TagController@tag_list']);

	Route::get('/', 'PostController@index');
	Route::resource('post', 'PostController', ['except' => ['create', 'show', 'index']]);
	Route::get('post/create', ['as' => 'post.create', 'uses' => 'PostController@create', 'middleware' => 'auth']);
	Route::get('{slug}', ['as' => 'post.show', 'uses' => 'PostController@show']);
	Route::get('post/{post}/delete', ['as' => 'post.delete', 'uses' => 'PostController@delete']);

	Route::resource('user', 'UserController');
	Route::get('user/{user}/delete', ['as' => 'user.delete', 'uses' => 'UserController@delete']);

	Route::get('tag/create', ['as' => 'tag.create', 'uses' => 'TagController@create']);
	Route::post('tag', ['as' => 'tag.store', 'uses' => 'TagController@store']);
	Route::get('tag/{id}', 'TagController@show');
	Route::get('tag/{tag}/delete', ['as' => 'tag.delete', 'uses' => 'TagController@delete']);
	Route::delete('tag/{tag}', ['as' => 'tag.destroy', 'uses' => 'TagController@destroy']);

	Route::get('auth/login', ['as' => 'login', 'uses' => 'Auth\AuthController@getLogin']);
	Route::get('auth/logout', ['as' => 'logout', 'uses' => 'Auth\AuthController@getLogout']);
	Route::post('auth/login', 'Auth\AuthController@postLogin');

	Route::get('auth/register', ['as' => 'register', 'uses' => 'Auth\AuthController@getRegister']);
	Route::post('auth/register', 'Auth\AuthController@postRegister');