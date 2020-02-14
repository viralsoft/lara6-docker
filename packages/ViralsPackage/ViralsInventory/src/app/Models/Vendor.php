<?php

namespace ViralsPackage\ViralsInventory\app\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;

class Vendor extends Model
{
    protected $table = 'vendors';

    public $timestamps = true;

    protected $fillable = ['name', 'email', 'phone', 'address', 'descriptions', 'city', 'zip',
        'fax', 'poc_email', 'poc_name', 'poc_phone', 'created_by', 'updated_by'];

    public function createdBy()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function updatedBy()
    {
        return $this->belongsTo(User::class, 'updated_by');
    }


}
