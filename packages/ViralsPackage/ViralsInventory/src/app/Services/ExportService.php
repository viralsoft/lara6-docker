<?php

namespace ViralsPackage\ViralsInventory\app\Services;

use ViralsPackage\ViralsInventory\app\Repositories\ExportRepository;

class ExportService
{
    protected $exportRepository;
    protected $warehouseService;
    protected $productService;
    protected $vendorService;

    public function __construct(
        ExportRepository $exportRepository,
        WarehouseService $warehouseService,
        ProductService $productService,
        VendorService $vendorService
    )
    {
        $this->exportRepository = $exportRepository;
        $this->warehouseService = $warehouseService;
        $this->productService = $productService;
        $this->vendorService = $vendorService;
    }

    public function all()
    {
        return $this->exportRepository->all();
    }

    public function paginate($perPage)
    {
        return $this->exportRepository->paginate($perPage);
    }

    public function create($data)
    {
        \DB::beginTransaction();
        try {
            $import = $this->exportRepository->create($data);
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

    public function findOrFail($id)
    {
        $store = $this->exportRepository->find($id);
        if (!$store) {
            return abort('404');
        }
        return $store;
    }

    public function update($data, $id)
    {
        return $this->exportRepository->update($data, $id);
    }

    private function getProductAndQuantity($data)
    {
        $dataExport = [];
        foreach ($data['product_id'] as $key => $value)
        {
            if (array_key_exists($value, $dataExport)) {
                $quantity = $dataExport[$value]['quantity'] - (float)$data['quantity'][$key];
                $dataExport[$value] = ['quantity' => $quantity];
            } else {
                $dataExport[$value] = ['quantity' => (float)(0 - $data['quantity'][$key])];
            }
        }
        return $dataExport;
    }
}
