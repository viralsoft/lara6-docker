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
        Route::get('stores/{store}', 'Admin\StoreController@show')->name('admin.stores.show');
        Route::get('stores/{store}/edit', 'Admin\StoreController@edit')->name('admin.stores.edit');
        Route::put('stores/{store}', 'Admin\StoreController@update')->name('admin.stores.update');

        // Authentication Routes...
        Route::get('warehouses', 'Admin\WarehouseController@index')->name('admin.warehouses.index');
        Route::get('warehouses/create', 'Admin\WarehouseController@create')->name('admin.warehouses.create');
        Route::post('warehouses', 'Admin\WarehouseController@store')->name('admin.warehouses.store');
        Route::get('warehouses/{store}', 'Admin\WarehouseController@show')->name('admin.warehouses.show');
        Route::get('warehouses/{store}/edit', 'Admin\WarehouseController@edit')->name('admin.warehouses.edit');
        Route::put('warehouses/{store}', 'Admin\WarehouseController@update')->name('admin.warehouses.update');
    });
