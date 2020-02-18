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
        'prefix'     => 'api',
        'as' => 'api.'
    ],
    function () {

        // Product Route
        Route::get('get-product-by-warehouse', 'Api\ProductApiController@getProductByWareHouse')->name('products.getByWarehouse');
    });
