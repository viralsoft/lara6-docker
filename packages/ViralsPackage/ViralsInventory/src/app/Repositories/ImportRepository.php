<?php

namespace ViralsPackage\ViralsInventory\app\Repositories;

use App\Repositories\BaseRepository;
use ViralsPackage\ViralsInventory\app\Models\Import;
use ViralsPackage\ViralsInventory\app\Models\Store;

class ImportRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = ['product_id', 'warehouse_id', 'vendor_id', 'quantity', 'date', 'created_by', 'updated_by'];

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
        return Import::class;
    }
}
