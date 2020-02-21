<?php

namespace ViralsPackage\ViralsInventory\app\Models;

use ViralsPackage\ViralsBase\app\Models\UserViral as User;
use Illuminate\Database\Eloquent\Model;

class Import extends Model
{
    protected $table = 'imports';

    protected $fillable = ['warehouse_id', 'vendor_id', 'date', 'created_by', 'updated_by'];

    public function products()
    {
        return $this->belongsToMany(Product::class, 'import_product', 'import_id', 'product_id')->withPivot('quantity');;
    }

    public function warehouse()
    {
        return $this->belongsTo(Warehouse::class, 'warehouse_id');
    }

    public function vendor()
    {
        return $this->belongsTo(Vendor::class, 'vendor_id');
    }

    public function createdBy()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function updatedBy()
    {
        return $this->belongsTo(User::class, 'updated_by');
    }
}
