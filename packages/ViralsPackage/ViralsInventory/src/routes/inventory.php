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
    });
