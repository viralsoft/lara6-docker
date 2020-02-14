<?php
namespace ViralsPackage\ViralsInventory\Tests\Unit;

use ViralsPackage\ViralsInventory\Tests\TestCase;
use ViralsPackage\ViralsInventory\app\Services\UnitService;
use Illuminate\Pagination\LengthAwarePaginator;

class UnitServiceTest extends TestCase
{

    public function test_it_can_create_an_unit()
    {
        $service = $this->app->make(UnitService::class);
        $this->assertInstanceOf(LengthAwarePaginator::class, $service->paginate(10));
    }
}
