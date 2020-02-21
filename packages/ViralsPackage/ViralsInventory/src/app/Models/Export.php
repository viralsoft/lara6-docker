<?php

namespace ViralsPackage\ViralsInventory\app\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;

class Export extends Model
{
    protected $table = 'exports';

    public $timestamps = true;

    protected $fillable = ['warehouse_id', 'date', 'created_by', 'updated_by'];

    public function createdBy()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function updatedBy()
    {
        return $this->belongsTo(User::class, 'updated_by');
    }

    public function warehouse()
    {
        return $this->belongsTo(Warehouse::class, 'warehouse_id');
    }

    public function products()
    {
        return $this->belongsToMany(Product::class, 'export_product', 'export_id', 'product_id')->withPivot('quantity');;
    }

}
