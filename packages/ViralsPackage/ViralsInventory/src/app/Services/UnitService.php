<?php


namespace ViralsPackage\ViralsInventory\app\Services;

use ViralsPackage\ViralsInventory\app\Repositories\UnitRepository;

class UnitService
{
    protected $unitRepository;

    public function __construct(UnitRepository $unitRepository)
    {
        $this->unitRepository = $unitRepository;
    }

    public function paginate($perPage)
    {
        return $this->unitRepository->paginate($perPage);
    }

    public function all()
    {
        return $this->unitRepository->all();
    }

    public function create($data)
    {
        return $this->unitRepository->create($data);
    }

    public function findOrFail($id)
    {
        $store = $this->unitRepository->find($id);
        if (!$store) {
            return abort('404');
        }
        return $store;
    }

    public function update($data, $id)
    {
        return $this->unitRepository->update($data, $id);
    }
}
