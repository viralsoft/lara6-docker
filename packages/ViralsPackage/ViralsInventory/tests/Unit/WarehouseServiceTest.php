<?php
namespace ViralsPackage\ViralsInventory\Tests\Unit;

use Illuminate\Database\Eloquent\Collection;
use ViralsPackage\ViralsInventory\app\Models\Product;
use ViralsPackage\ViralsInventory\app\Models\Store;
use ViralsPackage\ViralsInventory\app\Models\Unit;
use ViralsPackage\ViralsInventory\app\Models\Vendor;
use ViralsPackage\ViralsInventory\app\Models\Warehouse;
use ViralsPackage\ViralsInventory\app\Services\ImportService;
use ViralsPackage\ViralsInventory\Tests\TestCase;
use ViralsPackage\ViralsInventory\app\Services\WarehouseService;
use Illuminate\Pagination\LengthAwarePaginator;

class WarehouseServiceTest extends TestCase
{

    public function test_paginate_warehouse()
    {
        $service = $this->app->make(WarehouseService::class);
        $this->assertInstanceOf(LengthAwarePaginator::class, $service->paginate(10));
    }

    public function test_all_warehouse_service()
    {
        $service = $this->app->make(WarehouseService::class);
        $store = $this->setupStore();
        Warehouse::create([
            "name" => $this->faker->name,
            "address" => $this->faker->address,
            'store_id' => $store->id
        ]);
        $this->assertInstanceOf(Collection::class, $service->all());
    }

    public function test_can_create_warehouse_service()
    {
        $service = $this->app->make(WarehouseService::class);
        $store = $this->setupStore();
        $data = [
            "name" => $this->faker->name,
            "address" => $this->faker->address,
            'store_id' => $store->id
        ];
        $warehouse = $service->create($data);
        $this->assertEquals($warehouse->name, $data['name']);
        $this->assertEquals($warehouse->address, $data['address']);
        $this->assertEquals($warehouse->store_id, $data['store_id']);
        $this->assertEquals($warehouse->store->name, $store->name);
        $this->assertInstanceOf(Warehouse::class, $warehouse);
    }

    public function test_can_update_warehouse_service()
    {
        $service = $this->app->make(WarehouseService::class);
        $store1 = $this->setupStore();
        $store2 = $this->setupStore();
        $warehouse = Warehouse::create([
            "name" => $this->faker->name,
            "address" => $this->faker->address,
            'store_id' => $store1->id
        ]);
        $warehouseUpdate = $service->update([
            "name" => $this->faker->name,
            "address" => $this->faker->address,
            'store_id' => $store2->id
        ], $warehouse->id);
        $this->assertNotEquals($warehouseUpdate->name, $warehouse->name);
        $this->assertNotEquals($warehouseUpdate->address, $warehouse->address);
        $this->assertNotEquals($warehouseUpdate->store_id, $warehouse->store_id);
    }

    public function test_find_success_warehouse()
    {
        $service = $this->app->make(WarehouseService::class);
        $store = $this->setupStore();
        $data = [
            "name" => $this->faker->name,
            "address" => $this->faker->address,
            'store_id' => $store->id
        ];
        $warehouse = $service->create($data);
        $warehouseFind = $service->findOrFail($warehouse->id);
        $this->assertInstanceOf(Warehouse::class, $warehouseFind);
        $this->assertEquals($warehouseFind->id, $warehouse->id);
    }

    public function test_update_or_create_function()
    {
        $data = $this->setupData();
        $serviceImport = $this->app->make(ImportService::class);
        $dataProduct =$serviceImport->getProductAndQuantity($data);
        $service = $this->app->make(WarehouseService::class);
        $service->updateOrCreateProduct($data, $dataProduct);
        $warehouseFind = $service->findOrFail($data['warehouse_id']);
        $this->assertTrue(count($warehouseFind->products) == count($dataProduct));
    }

    private function setupStore()
    {
        $store = Store::create([
            "name" => $this->faker->name,
            "address" => $this->faker->address,
            "descriptions" => $this->faker->sentence($nbWords = 6, $variableNbWords = true),
            "manager_id" => $this->faker->randomDigitNotNull
        ]);
        return $store;
    }


    private function setupData()
    {
        $vendor = Vendor::create([
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
        $store = $this->setupStore();

        $warehouse = Warehouse::create([
            "name" => $this->faker->name,
            "address" => $this->faker->address,
            'store_id' => $store->id
        ]);
        $unit = Unit::create([
            "name" => $this->faker->name,
        ]);

        $product = Product::create([
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
