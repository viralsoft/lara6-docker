<?php

namespace ViralsPackage\ViralsInventory\app\Services;

use ViralsPackage\ViralsInventory\app\Repositories\ProductRepository;
use ViralsPackage\ViralsInventory\app\Repositories\UnitRepository;

class ProductService
{
    protected $productRepository;
    protected $unitRepository;

    public function __construct(
        ProductRepository $productRepository,
        UnitRepository $unitRepository
    ) {
        $this->productRepository = $productRepository;
        $this->unitRepository = $unitRepository;
    }

    public function all()
    {
        return $this->productRepository->all();
    }

    public function paginate($perPage)
    {
        return $this->productRepository->paginate($perPage);
    }

    public function getUnits()
    {
        return $this->unitRepository->all();
    }

    public function create($data)
    {
        return $this->productRepository->create($data);
    }

    public function findOrFail($id)
    {
        $product = $this->productRepository->find($id);
        if (!$product) {
            return abort('404');
        }
        return $product;
    }

    public function update($data, $id)
    {
        return $this->productRepository->update($data, $id);
    }
}
