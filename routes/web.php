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
    $a = 100;
    $b = $a + 1;
    $c = $b + 2;
    return $c;
    return view('welcome');
});

Route::get('/test', 'TestController@index');


