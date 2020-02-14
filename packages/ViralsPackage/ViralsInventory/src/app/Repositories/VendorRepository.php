<?php

namespace ViralsPackage\ViralsInventory\app\Repositories;

use ViralsPackage\ViralsInventory\app\Models\Vendor;

class VendorRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = ['name', 'email', 'phone', 'address', 'descriptions', 'city', 'zip',
        'fax', 'poc_email', 'poc_name', 'poc_phone', 'created_by', 'updated_by'];

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
        return Vendor::class;
    }
}
