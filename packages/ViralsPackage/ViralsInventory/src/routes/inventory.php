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
        Route::resource('imports', 'Admin\ImportController')->only([
            'index', 'show', 'create', 'store'
        ]);
        Route::get('imports/pdf/{import}', 'Admin\ImportController@exportPdf')->name('imports.pdf');

        // Product Route
        Route::resource('products', 'Admin\ProductController');

        // Unit Routes...
        Route::resource('units', 'Admin\UnitController');

        // Vendor Routes...
        Route::resource('vendors', 'Admin\VendorController');

        // Export Routes...
        Route::resource('exports', 'Admin\ExportController')->only([
            'index', 'show', 'create', 'store'
        ]);
        Route::get('exports/pdf/{import}', 'Admin\ExportController@exportPdf')->name('exports.pdf');

    });
