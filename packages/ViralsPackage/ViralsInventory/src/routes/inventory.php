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
        'prefix'     => 'admin'
    ],
    function () {
        // Store Routes...
        Route::resource('admin.stores', 'Admin\StoreController');

        // Warehouse Routes...
        Route::resource('admin.warehouses', 'Admin\WarehouseController');

        // Import Route
        Route::resource('admin.imports', 'Admin\ImportController');

        // Product Route
        Route::resource('admin.products', 'Admin\ProductController');

        // Unit Routes...
        Route::resource('admin.units', 'Admin\UnitController');

        // Vendor Routes...
        Route::resource('admin.vendors', 'Admin\UnitController');
    });
