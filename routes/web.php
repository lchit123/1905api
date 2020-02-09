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
Route::post('/test/post/sign2','Api\IndexController@sign2');
Route::post('/test/post/sign3','Api\IndexController@sign3');
Route::post('/test/post/sign3','Api\IndexController@encrtypt1');  //对称加密
Route::post('/test/post/sign3','Api\IndexController@encrtypt2');  //非对称加密

Route::get('/test/md5','Api\TestController@md5test');

Route::get('/test/rsa1','TestController@rsa1');

