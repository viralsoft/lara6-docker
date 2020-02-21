<?php
namespace ViralsPackage\ViralsInventory\Tests\Unit;

use Illuminate\Database\Eloquent\Collection;
use ViralsPackage\ViralsInventory\app\Models\Unit;
use ViralsPackage\ViralsInventory\app\Models\Product;
use ViralsPackage\ViralsInventory\Tests\TestCase;
use ViralsPackage\ViralsInventory\app\Services\ProductService;
use Illuminate\Pagination\LengthAwarePaginator;

class ProductServiceTest extends TestCase
{

    public function test_paginate_product()
    {
        $service = $this->app->make(ProductService::class);
        $this->assertInstanceOf(LengthAwarePaginator::class, $service->paginate(10));
    }

    public function test_all_product_service()
    {
        $service = $this->app->make(ProductService::class);
        $unit = $this->setupUnit();
        Product::create([
            "name" => $this->faker->name,
            "sku" => $this->faker->name,
            'unit_id' => $unit->id
        ]);
        $this->assertInstanceOf(Collection::class, $service->all());
    }

    public function test_can_create_product_service()
    {
        $service = $this->app->make(ProductService::class);
        $unit = $this->setupUnit();
        $data = [
            "name" => $this->faker->name,
            "sku" => $this->faker->name,
            'unit_id' => $unit->id
        ];
        $product = $service->create($data);
        $this->assertEquals($product->name, $data['name']);
        $this->assertEquals($product->sku, $data['sku']);
        $this->assertEquals($product->unit_id, $data['unit_id']);
        $this->assertEquals($product->unit->name, $unit->name);
        $this->assertInstanceOf(Product::class, $product);
    }

    public function test_can_update_product_service()
    {
        $service = $this->app->make(ProductService::class);
        $unit1 = $this->setupUnit();
        $unit2 = $this->setupUnit();
        $product = Product::create([
            "name" => $this->faker->name,
            "sku" => $this->faker->name,
            'unit_id' => $unit1->id
        ]);
        $productUpdate = $service->update([
            "name" => $this->faker->name,
            "sku" => $this->faker->name,
            'unit_id' => $unit2->id
        ], $product->id);
        $this->assertNotEquals($productUpdate->name, $product->name);
        $this->assertNotEquals($productUpdate->sku, $product->sku);
        $this->assertNotEquals($productUpdate->unit_id, $product->unit_id);
    }

    public function test_find_success_warehouse()
    {
        $service = $this->app->make(ProductService::class);
        $unit = $this->setupUnit();
        $data = [
            "name" => $this->faker->name,
            "sku" => $this->faker->name,
            'unit_id' => $unit->id
        ];
        $product = $service->create($data);
        $productFind = $service->findOrFail($product->id);
        $this->assertInstanceOf(Product::class, $productFind);
        $this->assertEquals($productFind->id, $product->id);
    }

    private function setupUnit()
    {
        $unit = Unit::create([
            "name" => $this->faker->name,
        ]);
        return $unit;
    }
}
