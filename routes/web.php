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

Route::get('/', function () {
	//echo phpinfo();
    return view('welcome');
});

Route::get('/test/postman','Api\TestController@postman');
Route::get('/test/postman1','Api\TestController@postman1')->middleware('filter','check.token');
