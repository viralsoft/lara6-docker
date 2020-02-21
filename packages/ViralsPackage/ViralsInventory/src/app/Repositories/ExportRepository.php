<?php

namespace ViralsPackage\ViralsInventory\app\Repositories;

use ViralsPackage\ViralsInventory\app\Models\Export;

class ExportRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = ['warehouse_id', 'date'];

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
