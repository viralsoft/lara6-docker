<?php


namespace ViralsPackage\ViralsInventory\Tests\Unit;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Pagination\LengthAwarePaginator;
use ViralsPackage\ViralsInventory\app\Models\Vendor;
use ViralsPackage\ViralsInventory\app\Services\VendorService;
use ViralsPackage\ViralsInventory\Tests\TestCase;

class VendorServiceTest extends TestCase
{
    public function test_paginate_vendor_service()
    {
        $service = $this->app->make(VendorService::class);
        $vendors = $service->paginate(10);
        $this->assertInstanceOf(LengthAwarePaginator::class, $vendors);
    }

    public function test_all_vendor_service()
    {
        $service = $this->app->make(VendorService::class);
        $vendors = $service->all();
        $this->assertInstanceOf(Collection::class, $vendors);
    }

    public function test_create_vendor_success()
    {
        $service = $this->app->make(VendorService::class);
        $dataVendor = $this->setupData();
        $vendor = $service->create($dataVendor);
        $this->assertInstanceOf(Model::class, $vendor);
        $this->assertEquals(count($service->all()), 1);
    }

    public function test_create_vendor_fail()
    {
        $service = $this->app->make(VendorService::class);
        $dataVendor = $this->setupData();
        unset($dataVendor['name']);
        $vendor = $service->create($dataVendor);
        $this->assertFalse($vendor);
    }

    public function test_update_vendor_success()
    {
        $service = $this->app->make(VendorService::class);
        $dataVendor = $this->setupData();
        $createVendor = $service->create($dataVendor);
        $createVendor->name = $this->faker->name;
        $vendor = $service->update($createVendor->toArray(), $createVendor->id);
        $this->assertInstanceOf(Model::class, $vendor);
    }

    public function test_update_vendor_fail()
    {
        $service = $this->app->make(VendorService::class);
        $dataVendor = $this->setupData();
        $createVendor = $service->create($dataVendor);
        $createVendor->name = null;
        $vendor = $service->update($createVendor->toArray(), $createVendor->id);
        $this->assertFalse($vendor);
    }

    public function test_find_success_vendor()
    {
        $service = $this->app->make(VendorService::class);
        $dataExport = $this->setupData();
        $vendor = $service->create($dataExport);
        $vendorFind = $service->findOrFail($vendor->id);
        $this->assertInstanceOf(Vendor::class, $vendorFind);
        $this->assertEquals($vendorFind->id,$vendor->id);
    }

    public function setupData()
    {
        $vendorService = $this->app->make(VendorService::class);
        $vendor = [
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
        ];
        return $vendor;
    }
}
