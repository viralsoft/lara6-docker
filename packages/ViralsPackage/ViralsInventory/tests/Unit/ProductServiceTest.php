<?php


namespace ViralsPackage\ViralsInventory\Tests\Unit;

use Illuminate\Pagination\LengthAwarePaginator;
use ViralsPackage\ViralsInventory\app\Services\ProductService;
use ViralsPackage\ViralsInventory\Tests\TestCase;

class ProductServiceTest extends TestCase
{
    public function test_it_can_create_an_unit()
    {
        $service = $this->app->make(ProductService::class);
        $this->assertInstanceOf(LengthAwarePaginator::class, $service->paginate(10));
    }
}