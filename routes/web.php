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

//官网
Route::group(['namespace' => 'Home'], function(){
    Route::get('/', function () {
        //return view('welcome');
        return view('child');
    });
    Route::get('/home', function () {
        //return view('welcome');
        return view('home');
    });   
});

//管理后台
Route::group(['namespace' => 'Admin', 'prefix' => 'houtai'], function(){
    Route::get('login', function () {
        //return view('welcome');
        return view('admin.login');
    });
    Route::get('/', function () {
        //return view('welcome');
        return view('admin.index');
    });
    Route::get('letuslearnenglish', function () {
        //return view('welcome');
        return view('admin.letuslearnenglish');
    });

    Route::resource('programs', 'ProgramController');

    //ajax请求都以ajax开头
    Route::post('ajax/programs/store', 'ProgramController@store');
    Route::post('ajax/programs/update/{id}', 'ProgramController@update');
});



