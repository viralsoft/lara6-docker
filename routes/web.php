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
    return view('welcome');
});




Auth::routes(['verify' => true]);

Route::get('/home', 'HomeController@index')->middleware('verified');

Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('permission', 'Admin\PermissionController@index')->name('permission.index');
    Route::post('permission', 'Admin\PermissionController@store')->name('permission.store');
    Route::delete('permission/{permissionId}', 'Admin\PermissionController@destroy')->name('permission.destroy');
    Route::resource('roles', 'Admin\RoleController');
    Route::get('users/roles/show', 'Admin\UserController@showPermission')->name('users.roles.permissions');
    Route::resource('users', 'Admin\UserController');
});