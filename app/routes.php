<?php

# ------------------ Pages Route ------------------------

Route::get('/', [
    'as' => 'home',
    'uses'=>'PagesController@home'
]);

Route::get('/about', [
    'as' => 'about',
    'uses' => 'PagesController@about'
]);


Route::get('/wiki', [
	'as' => 'wiki',
	'uses' => 'PagesController@wiki'
]);

# ------------------ Authentication ------------------------

Route::get('login', [
	'as' => 'login',
	'uses' => 'AuthController@login'
]);

Route::get('login-required', [
	'as' => 'login-required',
	'uses' => 'AuthController@loginRequired'
]);

Route::get('signup', [
	'as' => 'signup', 
	'uses' => 'AuthController@create'
]);

Route::post('signup',  [
	'as' => 'signup', 
	'uses' => 'AuthController@store'
]);

Route::get('logout', [
	'as' => 'logout',
	'uses' => 'AuthController@logout'
]);

Route::get('oauth', 'AuthController@getOauth');

# ------------------ Resource Route ------------------------

Route::resource('nodes', 'NodesController');
Route::resource('topics', 'TopicsController');
Route::resource('replies', 'RepliesController', ['only' => ['store']]);
Route::resource('votes', 'VotesController');
Route::resource('users', 'UsersController');
