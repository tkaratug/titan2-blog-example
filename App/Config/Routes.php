<?php
/*************************************************
 * Titan-2 Mini Framework
 * Routes
 *
 * Author 	: Turan Karatuğ
 * Web 		: http://www.titanphp.com
 * Docs 	: http://kilavuz.titanphp.com
 * Github	: http://github.com/tkaratug/titan2
 * License	: MIT
 *
 *************************************************/
use System\Libs\Router\Router as Route;

Route::set404(function(){
	header('HTTP/1.1 404 Not Found');
	View::render('errors.404');
});

Route::get('/', 'Home@index', ['namespace' => 'Frontend']);
Route::get('/categories/(\w+)', 'Home@categories', ['namespace' => 'Frontend']);

Route::get('/login', 'Auth@login', ['namespace' => 'Backend', 'middleware' => ['login']]);
Route::post('/login', 'Auth@doLogin', ['namespace' => 'Backend', 'middleware' => ['login']]);
Route::get('/logout', 'Auth@logout', ['namespace' => 'Backend', 'middleware' => ['auth']]);

Route::group('/backend', function(){
	Route::get('/', 'Dashboard@index');
	Route::get('/dashboard', 'Dashboard@index');

	// Articles
	Route::get('/articles', 'Articles@index');
	Route::get('/articles/create', 'Articles@create');
	Route::post('/articles/save', 'Articles@save');
	Route::get('/articles/edit/(\d+)', 'Articles@edit');
	Route::post('/articles/update/(\d+)', 'Articles@update');
	Route::post('/articles/delete/(\d+)', 'Articles@delete');

	// Categories
	Route::get('/categories', 'Categories@index');
	Route::get('/categories/create', 'Categories@create');
	Route::post('/categories/save', 'Categories@save');
	Route::get('/categories/edit/(\d+)', 'Categories@edit');
	Route::post('/categories/update/(\d+)', 'Categories@update');
	Route::post('/categories/delete/(\d+)', 'Categories@delete');

	// Admin
	Route::get('/admin', 'Admin@index');
	Route::post('/admin/update', 'Admin@update');
}, ['namespace' => 'Backend', 'middleware' => ['Auth']]);
