<?php

namespace ViralsPackage\ViralsInventory\app\Services;

use ViralsPackage\ViralsInventory\app\Repositories\ImportRepository;
use ViralsPackage\ViralsInventory\app\Repositories\WarehouseRepository;
use ViralsPackage\ViralsInventory\app\Repositories\ProductRepository;
use ViralsPackage\ViralsInventory\app\Repositories\VendorRepository;

class ImportService
{
    protected $importRepository;
    protected $warehouseRepository;
    protected $productRepository;
    protected $vendorRepository;

    public function __construct(
        ImportRepository $importRepository,
        WarehouseRepository $warehouseRepository,
        ProductRepository $productRepository,
        VendorRepository $vendorRepository
    ) {
        $this->importRepository = $importRepository;
        $this->warehouseRepository = $warehouseRepository;
        $this->productRepository = $productRepository;
        $this->vendorRepository = $vendorRepository;
    }

    public function paginate($perPage)
    {
        return $this->importRepository->with(['product', 'warehouse', 'vendor'])->paginate($perPage);
    }

    public function create($data)
    {
        return $this->importRepository->create($data);
    }

    public function update($data, $id)
    {
        return $this->importRepository->update($data, $id);
    }

    public function setupCreateData()
    {
        $data = [];
        $data['product'] = $this->productRepository->all()->pluck('name', 'id')->toArray();
        $data['warehouse'] = $this->warehouseRepository->all()->pluck('name', 'id')->toArray();
        $data['vendor'] = $this->vendorRepository->all()->pluck('name', 'id')->toArray();

        return $data;
    }
}
