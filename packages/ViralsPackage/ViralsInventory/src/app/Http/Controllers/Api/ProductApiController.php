<?php

namespace ViralsPackage\ViralsInventory\app\Http\Controllers\Api;

use Illuminate\Http\Request;
use ViralsPackage\ViralsInventory\app\Http\Controllers\ApiBaseController;
use ViralsPackage\ViralsInventory\app\Services\ProductService;

class ProductApiController extends ApiBaseController
{
    protected $productService; // the information we send to the view

    /**
     * Create a new controller instance.
     * @param ProductService $productService
     */
    public function __construct(ProductService $productService)
    {
        $this->productService = $productService;
    }

    public function getProductByWareHouse(Request $request)
    {
        $products = $this->productService->getProductByWarehouse($request->warehouse_id);
        return $this->sendResponse($products, 'Get product successfully.');
    }
}
