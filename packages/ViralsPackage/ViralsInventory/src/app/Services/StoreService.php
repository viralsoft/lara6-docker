<?php


namespace ViralsPackage\ViralsInventory\app\Services;

use ViralsPackage\ViralsInventory\app\Repositories\StoreRepository;

class StoreService
{
    protected $storeRepository;

    public function __construct(StoreRepository $storeRepository)
    {
        $this->storeRepository = $storeRepository;
    }

    public function all()
    {
        return $this->storeRepository->all();
    }

    public function paginate($perPage)
    {
        return $this->storeRepository->paginate($perPage);
    }

    public function create($data)
    {
        return $this->storeRepository->create($data);
    }

    public function findOrFail($id)
    {
        $store = $this->storeRepository->find($id);
        if (!$store) {
            return abort('404');
        }
        return $store;
    }

    public function update($data, $id)
    {
        return $this->storeRepository->update($data, $id);
    }
}