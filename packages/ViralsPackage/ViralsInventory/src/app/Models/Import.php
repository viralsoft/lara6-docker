<?php

namespace ViralsPackage\ViralsInventory\app\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;

class Import extends Model
{
    protected $table = 'imports';

    protected $fillable = ['product_id', 'warehouse_id', 'vendor_id', 'quantity', 'date', 'created_by', 'updated_by'];

    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }

    public function warehouse()
    {
        return $this->belongsTo(Warehouse::class, 'warehouse_id');
    }

    public function vendor()
    {
        return $this->belongsTo(Vendor::class, 'warehouse_id');
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
