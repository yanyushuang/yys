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

//登录
Route::get('/', function () {
    return view('login');
});

//登录验证
Route::controller('/login','LoginController');

//注册
Route::controller('/zhuce','ZhuceController');

//验证码
// Route::get('/code','CodeController@code');

//验证码
Route::get('/code','CodeController@code');
