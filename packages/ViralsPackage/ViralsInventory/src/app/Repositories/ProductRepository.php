<?php

namespace ViralsPackage\ViralsInventory\app\Repositories;

use App\Repositories\BaseRepository;
use ViralsPackage\ViralsInventory\app\Models\Product;

class ProductRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = ['sku', 'name', 'unit_id', 'created_by', 'updated_by'];

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
        return Product::class;
    }

    /**
     * Get product by warehouse
     *
     * @param $warehouse
     * @return
     */
    public function getProductByWareHouse($warehouse)
    {
        return $this->model()::whereHas('warehouses', function ($query) use($warehouse) {
            $query->where('warehouse_id', $warehouse);
        })->get();
    }
}
