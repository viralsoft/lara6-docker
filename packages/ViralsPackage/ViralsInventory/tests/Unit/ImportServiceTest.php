<?php


namespace ViralsPackage\ViralsInventory\Tests\Unit;


use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Tests\Integration\Queue\Product;
use ViralsPackage\ViralsInventory\app\Services\VendorService;
use ViralsPackage\ViralsInventory\app\Services\WarehouseService;
use ViralsPackage\ViralsInventory\Tests\TestCase;
use ViralsPackage\ViralsInventory\app\Services\ProductService;

class ImportServiceTest extends TestCase
{
    public function test_paginate_import_service()
    {
        $service = $this->app->make(ImportService::class);
        $this->assertInstanceOf(LengthAwarePaginator::class, $service->paginate(10));
    }

    public function test_can_create_import()
    {
        $vendorService = $this->app->make(VendorService::class);
        $vendor = $vendorService->create([
            "name" => $this->faker->name,
            "email" => $this->faker->email,
            "phone" => $this->faker->e164PhoneNumber,
            "address" => $this->faker->address,
            "descriptions" => $this->faker->sentence($nbWords = 6, $variableNbWords = true),
            "city" => "Hà Nội",
            "zip" => "1111",
            "fax" => "0379042574",
            "poc_email" => $this->faker->email,
            "poc_name" => $this->faker->name,
            "poc_phone" => $this->faker->e164PhoneNumber,
            "created_by" => 1
        ]);
        $warehouseService = $this->app->make(WarehouseService::class);
        $productService = $this->app->make(ProductService::class);
        $data = [
            'product_id' => $this->faker->randomDigitNotNull,
            'vendor_id' => $vendor->id,
            'warehouse_id' => $this->faker->randomDigitNotNull,
        ];
    }
}