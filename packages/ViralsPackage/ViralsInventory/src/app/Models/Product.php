<?php

namespace ViralsPackage\ViralsInventory\app\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $table = 'products';

    protected $fillable = ['sku', 'name', 'unit_id', 'created_by', 'updated_by'];

    public function unit()
    {
        return $this->belongsTo(Unit::class, 'unit_id');
    }
}
