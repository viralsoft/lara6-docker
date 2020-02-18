<?php


namespace ViralsPackage\ViralsInventory\Tests\Unit;

use Illuminate\Pagination\LengthAwarePaginator;
use ViralsPackage\ViralsInventory\app\Http\Controllers\Admin\ProductController;
use ViralsPackage\ViralsInventory\app\Services\ProductService;
use ViralsPackage\ViralsInventory\app\Models\Product;
use ViralsPackage\ViralsInventory\Tests\TestCase;

class ProductServiceTest extends TestCase
{
    public function test_can_not_create_without_name()
    {
        $arr = [
            'sku' => 'test sku',
            'name' => null,
            'unit_id' => 1
        ];
        $user = $this->setupFakeDatabase();
        $response = $this->followingRedirects()->actingAs($user)->post('/admin/products', $arr);
        $response->assertViewIs('virals-inventory::products.form');
        $response->assertSee('The name field is required.');
    }

    public function test_can_not_create_without_sku()
    {
        $arr = [
            'sku' => null,
            'name' => 'test name',
            'unit_id' => 1
        ];

        $user = $this->setupFakeDatabase();
        $response = $this->followingRedirects()->actingAs($user)->post('/admin/products', $arr);

        $response->assertViewIs('virals-inventory::products.form');
        $response->assertSee('The sku field is required.');
    }

    public function test_can_not_create_without_unit_id()
    {
        $arr = [
            'sku' => 'test sku',
            'name' => 'test name',
            'unit_id' => null
        ];

        $user = $this->setupFakeDatabase();
       $response = $this->followingRedirects()->actingAs($user)->post('/admin/products', $arr);

       $response->assertViewIs('virals-inventory::products.form');
       $response->assertSee('is required');
    }

    public function test_can_not_update_without_name()
   {
       $product = Product::first();
       $user = $this->setupFakeDatabase();
       $response = $this->followingRedirects()->actingAs($user)->put('/admin/products', ['name' => null], $product->id);

       $response->assertViewIs('virals-inventory::products.form');
       $response->assertSee('The name field is required.');
   }

   public function test_can_not_update_without_sku()
   {
       $product = Product::first();
       $user = $this->setupFakeDatabase();
       $response = $this->followingRedirects()->actingAs($user)->put('/admin/products', ['sku' => null], $product->id);

       $response->assertViewIs('virals-inventory::products.form');
       $response->assertSee('The sku field is required.');
   }

   public function test_can_not_update_without_unit_id()
   {
       $product = Product::first();
       $user = $this->setupFakeDatabase();
       $response = $this->followingRedirects()->actingAs($user)->put('/admin/products', ['unit_id' => null], $product->id);

       $response->assertViewIs('virals-inventory::products.form');
       $response->assertSee('is required');
   }

}
