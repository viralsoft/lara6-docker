<?php

/*
|--------------------------------------------------------------------------
| ViralsPackage\ViralsInventory Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are
| handled by the ViralsPackage\ViralsInventory package.
|
*/

Route::group(
    [
        'namespace'  => 'ViralsPackage\ViralsInventory\app\Http\Controllers',
        'middleware' => 'web',
        'prefix'     => 'admin',
    ],
    function () {
        // Authentication Routes...
        Route::get('stores', 'Admin\StoreController@index')->name('admin.stores.index');
        Route::get('stores/create', 'Admin\StoreController@create')->name('admin.stores.create');
        Route::post('stores', 'Admin\StoreController@store')->name('admin.stores.store');
        Route::get('store/{store}', 'Admin\StoreController@show')->name('admin.stores.show');
        Route::get('store/{store}/edit', 'Admin\StoreController@edit')->name('admin.stores.edit');
        Route::put('store/{store}', 'Admin\StoreController@update')->name('admin.stores.update');
    });
