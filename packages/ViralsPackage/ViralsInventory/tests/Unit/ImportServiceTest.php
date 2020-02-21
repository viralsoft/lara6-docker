<?php


namespace ViralsPackage\ViralsInventory\Tests\Unit;


use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Pagination\LengthAwarePaginator;
use ViralsPackage\ViralsInventory\app\Models\Import;
use ViralsPackage\ViralsInventory\app\Services\ImportService;
use ViralsPackage\ViralsInventory\app\Services\StoreService;
use ViralsPackage\ViralsInventory\app\Services\UnitService;
use ViralsPackage\ViralsInventory\app\Services\VendorService;
use ViralsPackage\ViralsInventory\app\Services\WarehouseService;
use ViralsPackage\ViralsInventory\Tests\TestCase;
use ViralsPackage\ViralsInventory\app\Services\ProductService;

class ImportServiceTest extends TestCase
{
    public function test_paginate_import_service()
    {
        $service = $this->app->make(ImportService::class);
        $imports = $service->paginate(10);
        $this->assertInstanceOf(LengthAwarePaginator::class, $imports);
    }

    public function test_all_import_service()
    {
        $service = $this->app->make(ImportService::class);
        $imports = $service->all();
        $this->assertInstanceOf(Collection::class, $imports);
    }


    public function test_function_setup_create_data_import()
    {
        $service = $this->app->make(ImportService::class);
        $dataImport = $this->setupData();
        $data = $service->setupCreateData();
        $this->assertInstanceOf(Collection::class, $data['products']);
        $this->assertIsArray( $data['warehouses']);
        $this->assertArrayHasKey($dataImport['warehouse_id'] , $data['warehouses']);
        $this->assertArrayHasKey($dataImport['vendor_id'] , $data['vendors']);
        $this->assertIsArray( $data['vendors']);
    }

    public function test_create_import_success()
    {
        $service = $this->app->make(ImportService::class);
        $dataImport = $this->setupData();
        $import = $service->create($dataImport);
        $import->load('products');
        $this->assertInstanceOf(Model::class, $import);
        $this->assertEquals(count($service->all()), 1);
        $this->assertEquals($import->warehouse_id, $dataImport['warehouse_id']);
        $this->assertEquals($import->vendor_id, $dataImport['vendor_id']);
        $this->assertEquals(count($import->products), count($dataImport['product_id']));
    }

    public function test_create_import_fail()
    {
        $service = $this->app->make(ImportService::class);
        $dataImport = $this->setupData();
        unset($dataImport['warehouse_id']);
        $import = $service->create($dataImport);
        $this->assertFalse($import);
    }

    public function test_find_success_import()
    {
        $service = $this->app->make(ImportService::class);
        $dataImport = $this->setupData();
        $import = $service->create($dataImport);
        $importFind = $service->findOrFail($import->id);
        $this->assertInstanceOf(Import::class, $importFind);
        $this->assertEquals($importFind->id,$import->id);
    }

    private function setupData()
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
        ]);
        $storeService = $this->app->make(StoreService::class);
        $store = $storeService->create([
            "name" => $this->faker->name,
            "address" => $this->faker->address,
            "descriptions" => $this->faker->sentence($nbWords = 6, $variableNbWords = true),
            "manager_id" => $this->faker->randomDigitNotNull
        ]);

        $warehouseService = $this->app->make(WarehouseService::class);
        $warehouse = $warehouseService->create([
            "name" => $this->faker->name,
            "address" => $this->faker->address,
            'store_id' => $store->id
        ]);
        $productService = $this->app->make(ProductService::class);

        $unitService = $this->app->make(UnitService::class);

        $unit = $unitService->create([
            "name" => $this->faker->name,
        ]);

        $product = $productService->create([
            "name" => $this->faker->name,
            "sku" => $this->faker->name,
            'unit_id' => $unit->id
        ]);
        $data = [
            'product_id' => [$product->id],
            'quantity' => [$this->faker->randomDigitNotNull],
            'vendor_id' => $vendor->id,
            'warehouse_id' => $warehouse->id,
            'date' => date('Y-m-d H:i:s')
        ];
        return $data;
    }
}
