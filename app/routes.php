<?php

# ------------------ Pages Route ------------------------

Route::get('/', [
    'as' => 'pages.home',
    'uses'=>'PagesController@home'
]);

Route::get('/about', [
    'as' => 'pages.about',
    'uses' => 'PagesController@about'
]);


Route::get('/wiki', [
	'as' => 'pages.wiki',
	'uses' => 'PagesController@wiki'
]);

# ------------------ User stuff ------------------------

Route::get('/users/{id}/replies', [
	'as' => 'users.replies',
	'uses' => 'UsersController@replies'
]);

Route::get('/users/{id}/topics', [
	'as' => 'users.topics',
	'uses' => 'UsersController@topics'
]);

Route::get('/users/{id}/favorites', [
	'as' => 'users.favorites',
	'uses' => 'UsersController@favorites'
]);

Route::get('/favorites/{id}', [
	'as' => 'favorites.createOrDelete',
	'uses' => 'FavoritesController@createOrDelete',
	'before' => 'auth'
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

Route::get('admin-required', [
	'as' => 'admin-required',
	'uses' => 'AuthController@adminRequired'
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

# ------------------ Admin Route ------------------------

Route::get('topics/recomend/{id}',  [
	'as' => 'topics.recomend', 
	'uses' => 'TopicsController@recomend',
	'before' => 'manage_topics'
]);

Route::get('topics/wiki/{id}',  [
	'as' => 'topics.wiki',
	'uses' => 'TopicsController@wiki',
	'before' => 'manage_topics'
]);

Route::get('topics/delete/{id}',  [
	'as' => 'topics.delete', 
	'uses' => 'TopicsController@delete',
	'before' => 'manage_topics'
]);


