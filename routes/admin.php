<?php

/*
|--------------------------------------------------------------------------
| Admin Routes
|--------------------------------------------------------------------------
|
| Here is where you can register admin routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

//管理后台
Route::get('login', function () {
    //return view('welcome');
    return view('admin.login');
});
Route::get('/', function () {
    //return view('welcome');
    return view('admin.index');
});

Route::post('/programs/get_types', 'ProgramController@getTypesByCatId');

Route::resource('program_types', 'ProgramTypeController');
Route::resource('programs', 'ProgramController');
Route::resource('anchors', 'AnchorController');
Route::resource('ads', 'AdController');
