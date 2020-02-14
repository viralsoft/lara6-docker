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

    public function test_if_can_create_product()
    {
    	 $service = $this->app->make(ProductService::class);
       $chart = OrganizationalChart::first();
       $user = BackpackUser::first();

       $result = $service->updateChartUserByUserId($chart->id, $user->id);
       $this->assertEquals($result['status'], true);
       $this->assertArrayHasKey('data', $result);

       $chart->refresh();

       $this->assertInstanceOf(EloquentCollection::class, $result['data']['children']);
   }
      
}
