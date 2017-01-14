<?php

/*
|--------------------------------------------------------------------------
| Wxminiapp Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

//认证路由
Route::post('/auth/token', 'AuthController@token');
Route::post('/user/info', 'UserController@info');
Route::post('/program/timeline', 'ProgramController@timeline');
