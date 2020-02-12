<?php

namespace ViralsPackage\ViralsInventory\app\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;

class Warehouse extends Model
{
    protected $table = 'warehouses';

    protected $fillable = ['name', 'address', 'store_id', 'status', 'created_by', 'updated_by'];

    public function createdBy()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function updatedBy()
    {
        return $this->belongsTo(User::class, 'updated_by');
    }

    public function store()
    {
        return $this->belongsTo(Store::class, 'store_id');
    }
}
