<?php

namespace ViralsPackage\ViralsInventory\app\Services;

use ViralsPackage\ViralsInventory\app\Models\Warehouse;
use ViralsPackage\ViralsInventory\app\Repositories\ImportRepository;
use ViralsPackage\ViralsInventory\app\Services\WarehouseService;
use ViralsPackage\ViralsInventory\app\Services\ProductService;
use ViralsPackage\ViralsInventory\app\Services\VendorService;

class ImportService
{
    protected $importRepository;
    protected $warehouseService;
    protected $productService;
    protected $vendorService;

    public function __construct(
        ImportRepository $importRepository,
        WarehouseService $warehouseService,
        ProductService $productService,
        VendorService $vendorService
    )
    {
        $this->importRepository = $importRepository;
        $this->warehouseService = $warehouseService;
        $this->productService = $productService;
        $this->vendorService = $vendorService;
    }

    public function paginate($perPage)
    {
        return $this->importRepository->with(['warehouse', 'vendor'])->paginate($perPage);
    }

    public function findOrFail($id)
    {
        $store = $this->importRepository->find($id);
        if (!$store) {
            return abort('404');
        }
        return $store;
    }

    public function create($data)
    {
        \DB::beginTransaction();
        try {
            $import = $this->importRepository->create($data);
            $dataProduct = $this->getProductAndQuantity($data);
            foreach ($data['product_id'] as $key => $value) {
                $import->products()->attach($value, ['quantity' => $data['quantity'][$key]]);
            }
            $this->warehouseService->updateOrCreateProduct($data, $dataProduct);
            \DB::commit();
            return true;
        } catch (\Exception $e) {
            \DB::rollback();
            return false;
        }
    }

    public function update($data, $id)
    {
        return $this->importRepository->update($data, $id);
    }

    public function setupCreateData()
    {
        $data = [];
        $products = $this->productService->all();
        $products->load('unit');
        $data['products'] = $products;
        $data['warehouses'] = $this->warehouseService->all()->pluck('name', 'id')->toArray();
        $data['vendors'] = $this->vendorService->all()->pluck('name', 'id')->toArray();

        return $data;
    }

    private function getProductAndQuantity($data)
    {
        $dataImport = [];
        foreach ($data['product_id'] as $key => $value)
        {
            if (array_key_exists($value, $dataImport)) {
                $quantity = $dataImport[$value]['quantity'] + $data['quantity'][$key];
                $dataImport[$value] = ['quantity' => $quantity];
            } else {
                $dataImport[$value] = ['quantity' => $data['quantity'][$key]];
            }
        }
        return $dataImport;
    }
}
