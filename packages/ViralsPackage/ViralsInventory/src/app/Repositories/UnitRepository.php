<?php

namespace ViralsPackage\ViralsInventory\app\Repositories;

//use App\Repositories\BaseRepository;
use ViralsPackage\ViralsInventory\app\Models\Unit;

class UnitRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = ['name'];

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
        return Unit::class;
    }
}