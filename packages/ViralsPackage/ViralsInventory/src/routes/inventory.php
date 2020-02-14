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
        // Store Routes...
        Route::get('stores', 'Admin\StoreController@index')->name('admin.stores.index');
        Route::get('stores/create', 'Admin\StoreController@create')->name('admin.stores.create');
        Route::post('stores', 'Admin\StoreController@store')->name('admin.stores.store');
        Route::get('stores/{store}', 'Admin\StoreController@show')->name('admin.stores.show');
        Route::get('stores/{store}/edit', 'Admin\StoreController@edit')->name('admin.stores.edit');
        Route::put('stores/{store}', 'Admin\StoreController@update')->name('admin.stores.update');

        // Warehouse Routes...
        Route::get('warehouses', 'Admin\WarehouseController@index')->name('admin.warehouses.index');
        Route::get('warehouses/create', 'Admin\WarehouseController@create')->name('admin.warehouses.create');
        Route::post('warehouses', 'Admin\WarehouseController@store')->name('admin.warehouses.store');
        Route::get('warehouses/{store}', 'Admin\WarehouseController@show')->name('admin.warehouses.show');
        Route::get('warehouses/{store}/edit', 'Admin\WarehouseController@edit')->name('admin.warehouses.edit');
        Route::put('warehouses/{store}', 'Admin\WarehouseController@update')->name('admin.warehouses.update');

        // Import Route
        Route::get('imports', 'Admin\ImportController@index')->name('admin.imports.index');
        Route::get('imports/create', 'Admin\ImportController@create')->name('admin.imports.create');
        Route::post('imports', 'Admin\ImportController@store')->name('admin.imports.store');
        Route::get('imports/{id}', 'Admin\ImportController@show')->name('admin.imports.show');
        Route::get('imports/{id}/edit', 'Admin\ImportController@edit')->name('admin.imports.edit');
        Route::put('imports/{id}', 'Admin\ImportController@update')->name('admin.imports.update');

        // Product Route
        Route::get('products', 'Admin\ProductController@index')->name('admin.products.index');
        Route::get('products/create', 'Admin\ProductController@create')->name('admin.products.create');
        Route::post('products', 'Admin\ProductController@store')->name('admin.products.store');
        Route::get('products/{id}', 'Admin\ProductController@show')->name('admin.products.show');
        Route::get('products/{id}/edit', 'Admin\ProductController@edit')->name('admin.products.edit');
        Route::put('products/{id}', 'Admin\ProductController@update')->name('admin.products.update');
        Route::delete('products/{id}', 'Admin\ProductController@destroy')->name('admin.products.destroy');

        // Unit Routes...
        Route::get('units', 'Admin\UnitController@index')->name('admin.units.index');
        Route::get('units/create', 'Admin\UnitController@create')->name('admin.units.create');
        Route::post('units', 'Admin\UnitController@store')->name('admin.units.store');
        Route::get('units/{store}', 'Admin\UnitController@show')->name('admin.units.show');
        Route::get('units/{store}/edit', 'Admin\UnitController@edit')->name('admin.units.edit');
        Route::put('units/{store}', 'Admin\UnitController@update')->name('admin.units.update');
    });
