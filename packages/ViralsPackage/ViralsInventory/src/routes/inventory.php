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
        'as' => 'admin.'
    ],
    function () {
        // Store Routes...
        Route::resource('stores', 'Admin\StoreController');

        // Warehouse Routes...
        Route::resource('warehouses', 'Admin\WarehouseController');

        // Import Route
        Route::resource('imports', 'Admin\ImportController');

        // Product Route
        Route::resource('products', 'Admin\ProductController');

        // Unit Routes...
        Route::resource('units', 'Admin\UnitController');

        // Vendor Routes...
        Route::resource('vendors', 'Admin\UnitController');
    });
