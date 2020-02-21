<?php


namespace ViralsPackage\ViralsInventory\app\Services;

use ViralsPackage\ViralsInventory\app\Repositories\WarehouseRepository;

class WarehouseService
{
    protected $warehouseRepository;

    public function __construct(WarehouseRepository $warehouseRepository)
    {
        $this->warehouseRepository = $warehouseRepository;
    }

    public function all()
    {
        return $this->warehouseRepository->all();
    }

    public function paginate($perPage)
    {
        return $this->warehouseRepository->paginate($perPage);
    }

    public function create($data)
    {
        return $this->warehouseRepository->create($data);
    }

    public function findOrFail($id)
    {
        $store = $this->warehouseRepository->find($id);
        if (!$store) {
            return abort('404');
        }
        return $store;
    }

    public function update($data, $id)
    {
        return $this->warehouseRepository->update($data, $id);
    }

    public function updateOrCreateProduct($data, $dataProduct)
    {
        $warehouse = $this->findOrFail($data['warehouse_id']);
        $warehouse->load('products');
        foreach ($dataProduct as $key => $value) {
            $product = $warehouse->products()->where('id', $key)->first();
            if (!$product) {
                $this->warehouseRepository->createProduct($warehouse, $key, $value);
            } else {
                $value['quantity'] = $value['quantity'] + $product->pivot->quantity;
                $this->warehouseRepository->updateProduct($warehouse, $key, $value);
            }
        }
    }
}
