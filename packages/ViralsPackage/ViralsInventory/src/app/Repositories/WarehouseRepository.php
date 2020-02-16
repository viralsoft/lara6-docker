<?php

namespace ViralsPackage\ViralsInventory\app\Repositories;

use ViralsPackage\ViralsInventory\app\Models\Warehouse;

class WarehouseRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = ['name', 'address', 'store_id', 'status', 'created_by', 'updated_by'];

    /**
     * Return searchable fields
     *
     * @return array
     */
    public function getFieldsSearchable()
    {
        return $this->fieldSearchable;
    }

    /**
     * Configure the Model
     **/
    public function model()
    {
        return Warehouse::class;
    }

    public function createProduct($warehouse, $productId, $dataQuantity)
    {
        return $warehouse->products()->attach($productId, $dataQuantity);
    }

    public function updateProduct($warehouse, $productId, $dataQuantity)
    {
        return $warehouse->products()->updateExistingPivot($productId, $dataQuantity);
    }
}