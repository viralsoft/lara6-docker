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
}