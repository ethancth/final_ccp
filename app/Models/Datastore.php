<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Datastore extends Model
{
    use HasFactory;
    protected $fillable = [
        'host_id', 'host_name','ds_id','ds_name','ds_freespace','ds_uncommitted','ds_capacity','ds_multiple_host','ds_accessible'
        ,'ds_overall_status','ds_type','sync_status','cost_profile_id',
    ];
    public function costprofile()
    {
        return $this->hasOne('App\Models\DatastoreCostProfile','id','cost_profile_id');
    }
}
