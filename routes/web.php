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

Route::get('/', "PostsController@index");

Route::get('/posts/create', "PostsController@create");

Route::get('/posts/{post}', "PostsController@show");

Route::post('/post', "PostsController@store");

Route::post('image-submit', "PostsController@image");

Route::get('/posts/{post}/edit', "PostsController@edit");

Route::patch('/posts/{post}', "PostsController@update");

Route::delete('/posts/{post}', "PostsController@destroy");

Route::get('/all-posts-csv', "PostsController@export");

Route::post('/post/import', 'PostsController@import');