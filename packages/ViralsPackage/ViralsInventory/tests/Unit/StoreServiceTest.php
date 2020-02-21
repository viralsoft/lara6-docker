<?php
namespace ViralsPackage\ViralsInventory\Tests\Unit;

use Illuminate\Database\Eloquent\Collection;
use ViralsPackage\ViralsInventory\app\Models\Store;
use ViralsPackage\ViralsInventory\Tests\TestCase;
use ViralsPackage\ViralsInventory\app\Services\StoreService;
use Illuminate\Pagination\LengthAwarePaginator;

class StoreServiceTest extends TestCase
{

    public function test_paginate_store()
    {
        $service = $this->app->make(StoreService::class);
        $this->assertInstanceOf(LengthAwarePaginator::class, $service->paginate(10));
    }

    public function test_all_store_service()
    {
        $service = $this->app->make(StoreService::class);
        Store::create([
            "name" => $this->faker->name,
            "address" => $this->faker->address,
            "descriptions" => $this->faker->sentence($nbWords = 6, $variableNbWords = true),
            "manager_id" => $this->faker->randomDigitNotNull
        ]);
        $this->assertInstanceOf(Collection::class, $service->all());
    }

    public function test_can_create_store_service()
    {
        $service = $this->app->make(StoreService::class);
        $data = [
            "name" => $this->faker->name,
            "address" => $this->faker->address,
            "descriptions" => $this->faker->sentence($nbWords = 6, $variableNbWords = true),
            "manager_id" => $this->faker->randomDigitNotNull
        ];
        $store = $service->create($data);
        $this->assertEquals($store->name, $data['name']);
        $this->assertEquals($store->address, $data['address']);
        $this->assertEquals($store->descriptions, $data['descriptions']);
        $this->assertEquals($store->manager_id, $data['manager_id']);
        $this->assertInstanceOf(Store::class, $store);
    }

    public function test_can_update_store_service()
    {
        $service = $this->app->make(StoreService::class);
        $store = Store::create([
            "name" => 'Store 1',
            "address" => $this->faker->address,
            "descriptions" => $this->faker->sentence($nbWords = 6, $variableNbWords = true),
            "manager_id" => $this->faker->randomDigitNotNull
        ]);
        $storeUpdate = $service->update([
            "name" => 'Store 2',
            "address" => $this->faker->address,
            "descriptions" => $this->faker->sentence($nbWords = 6, $variableNbWords = true),
            "manager_id" => $this->faker->randomDigitNotNull
        ], $store->id);
        $this->assertNotEquals($storeUpdate->name, $store->name);
        $this->assertNotEquals($storeUpdate->address, $store->address);
        $this->assertNotEquals($storeUpdate->descriptions, $store->descriptions);
    }

    public function test_find_success_store()
    {
        $service = $this->app->make(StoreService::class);
        $data = [
            "name" => $this->faker->name,
            "address" => $this->faker->address,
            "descriptions" => $this->faker->sentence($nbWords = 6, $variableNbWords = true),
            "manager_id" => $this->faker->randomDigitNotNull
        ];
        $store = $service->create($data);
        $storeFind = $service->findOrFail($store->id);
        $this->assertInstanceOf(Store::class, $storeFind);
        $this->assertEquals($storeFind->id, $store->id);
    }
}
