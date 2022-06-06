<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VmDatastore extends Model
{
    protected $fillable = ['vm_id','ds_id','ds_name','ds_unshared','ds_uncommitted','ds_committed'];

}
