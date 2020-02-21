<?php


namespace ViralsPackage\ViralsInventory\Tests\Unit;


use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Str;
use Illuminate\Tests\Integration\Queue\Product;
use ViralsPackage\ViralsInventory\app\Models\Export;
use ViralsPackage\ViralsInventory\app\Services\ExportService;
use ViralsPackage\ViralsInventory\app\Services\ImportService;
use ViralsPackage\ViralsInventory\app\Services\VendorService;
use ViralsPackage\ViralsInventory\app\Services\WarehouseService;
use ViralsPackage\ViralsInventory\Tests\TestCase;
use ViralsPackage\ViralsInventory\app\Services\ProductService;

class ExportServiceTest extends TestCase
{
    public function test_paginate_export_service()
    {
        $service = $this->app->make(ExportService::class);
        $exports = $service->paginate(10);
        $this->assertInstanceOf(LengthAwarePaginator::class, $exports);
    }

    public function test_all_export_service()
    {
        $service = $this->app->make(ExportService::class);
        $exports = $service->all();
        $this->assertInstanceOf(Collection::class, $exports);
    }

    public function test_function_setup_create_data_export()
    {
        $service = $this->app->make(ExportService::class);
        $dataExport = $this->setupData();
        $data = $service->setupCreateData();
        $this->assertInstanceOf(Collection::class, $data['products']);
        $this->assertIsArray( $data['warehouses']);
        $this->assertArrayHasKey($dataExport['warehouse_id'] , $data['warehouses']);
    }

    public function test_create_export_success()
    {
        $service = $this->app->make(ExportService::class);
        $dataExport = $this->setupData();
        $export = $service->create($dataExport);
        $export->load('products');
        $this->assertInstanceOf(Model::class, $export);
        $this->assertEquals(count($service->all()), 1);
        $this->assertEquals($export->warehouse_id, $dataExport['warehouse_id']);
        $this->assertEquals(count($export->products), count($dataExport['product_id']));
    }

    public function test_create_export_fail()
    {
        $service = $this->app->make(ExportService::class);
        $dataExport = $this->setupData();
        unset($dataExport['warehouse_id']);
        $export = $service->create($dataExport);
        $this->assertFalse($export);
    }

    public function test_find_success_export()
    {
        $service = $this->app->make(ExportService::class);
        $dataExport = $this->setupData();
        $export = $service->create($dataExport);
        $exportFind = $service->findOrFail($export->id);
        $this->assertInstanceOf(Export::class, $exportFind);
        $this->assertEquals($exportFind->id,$export->id);
    }

    public function setupData()
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
        $warehouse = $warehouseService->create([
            "name" => $this->faker->name,
            "address" => $this->faker->address,
            'store_id' => $this->faker->randomDigitNotNull,
            'status' => rand(0,2),
            "created_by" => 1
        ]);
        $product = $productService->create([
            'sku' => Str::random(8),
            'name' => $this->faker->name,
            'unit_id' => $this->faker->randomDigitNotNull,
            "created_by" => 1
        ]);
        $importService = $this->app->make(ImportService::class);
        $import = $importService->create([
            'warehouse_id' => $warehouse->id,
            'vendor_id' => $vendor->id,
            'date' => "2020-02-12 02:04:00",
            'product_id' => [
                0 => $product->id
            ],
            'quantity' => [
                0 => rand(50, 100)
            ],
            'created_by' => 1
        ]);
        $exportService = $this->app->make(ExportService::class);
        $export = [
            'warehouse_id' => $warehouse->id,
            'date' => "2020-02-12 02:04:00",
            'product_id' => [
                0 => $product->id
            ],
            'quantity' => [
                0 => rand(1, 49)
            ],
            'created_by' => 1
        ];
        return $export;
    }

}
