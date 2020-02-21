<?php

namespace ViralsPackage\ViralsInventory\app\Repositories;

use ViralsPackage\ViralsInventory\app\Models\Export;
use ViralsPackage\ViralsInventory\app\Repositories\BaseRepository;

class ExportRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = ['warehouse_id', 'date', 'created_by', 'updated_by'];

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
        return Export::class;
    }
}
