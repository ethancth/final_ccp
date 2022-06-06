<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cluster extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'domain_id','cost_profile_id','department_id',
    ];

    public function vms()
    {
        return $this->hasMany('App\Models\Vmtable','cluster_id','domain_id');
    }


    public function costprofile()
    {
        return $this->hasOne('App\Models\CostProfile','id','cost_profile_id');
    }

    public function department()
    {
        return $this->hasOne('App\Models\Department','id','department_id');
    }
}
