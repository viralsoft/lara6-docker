<?php
namespace ViralsPackage\ViralsInventory\Tests\Unit;

use Illuminate\Database\Eloquent\Collection;
use ViralsPackage\ViralsInventory\app\Models\Unit;
use ViralsPackage\ViralsInventory\Tests\TestCase;
use ViralsPackage\ViralsInventory\app\Services\UnitService;
use Illuminate\Pagination\LengthAwarePaginator;

class UnitServiceTest extends TestCase
{

    public function test_paginate_unit()
    {
        $service = $this->app->make(UnitService::class);
        $this->assertInstanceOf(LengthAwarePaginator::class, $service->paginate(10));
    }

    public function test_all_unit_service()
    {
        $service = $this->app->make(UnitService::class);
        Unit::create([
            'name' => $this->faker->name
        ]);
        $this->assertInstanceOf(Collection::class, $service->all());
    }

    public function test_can_create_unit_service()
    {
        $service = $this->app->make(UnitService::class);
        $data = [
            'name' => $this->faker->name
        ];
        $unit = $service->create($data);
        $this->assertEquals($unit->name, $data['name']);
        $this->assertInstanceOf(Unit::class, $unit);
    }

    public function test_can_update_unit_service()
    {
        $service = $this->app->make(UnitService::class);
        $unit = Unit::create([
            'name' => 'Mạnh'
        ]);
        $unitUpdate = $service->update([
            'name' => 'Long'
        ], $unit->id);
        $this->assertNotEquals($unitUpdate->name, $unit->name);
    }
}
