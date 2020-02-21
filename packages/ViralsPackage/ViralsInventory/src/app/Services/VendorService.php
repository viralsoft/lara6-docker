<?php


namespace ViralsPackage\ViralsInventory\app\Services;

use ViralsPackage\ViralsInventory\app\Repositories\VendorRepository;

class VendorService
{
    protected $vendorRepository;

    public function __construct(VendorRepository $vendorRepo)
    {
        $this->vendorRepository = $vendorRepo;
    }

    public function all()
    {
        return $this->vendorRepository->all();
    }

    public function paginate($perPage)
    {
        return $this->vendorRepository->paginate($perPage);
    }

    public function create($data)
    {
        \DB::beginTransaction();
        try {
            $vendor = $this->vendorRepository->create($data);
            \DB::commit();
            return $vendor;
        } catch (\Exception $e) {
            \DB::rollback();
            return false;
        }
    }

    public function findOrFail($id)
    {
        $store = $this->vendorRepository->find($id);
        if (!$store) {
            return abort('404');
        }
        return $store;
    }

    public function update($data, $id)
    {
        \DB::beginTransaction();
        try {
            $vendor = $this->vendorRepository->update($data, $id);
            \DB::commit();
            return $vendor;
        } catch (\Exception $e) {
            \DB::rollback();
            return false;
        }
    }
}
