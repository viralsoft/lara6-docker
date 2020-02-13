<?php

namespace ViralsPackage\ViralsInventory\app\Models;

use Illuminate\Database\Eloquent\Model;

class Unit extends Model
{
    protected $table = 'units';

    protected $fillable = ['name'];
}
