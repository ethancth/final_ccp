<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProjectServer extends Model
{
    use HasFactory;

    protected $fillable = [
        'project_id','operating_system',
        'v_cpu','v_memory','environment','tier',
        'hostname', 'owner','created_at', 'updated_at',
        'total_storage','operating_system_option','optional_sa_field','mandatory_sa_field',
        'display_os','display_tier','display_env','price','is_vm_provision',
        'is_asset_vm'
    ];

    public function project()
    {
        return $this->belongsTo(Project::class,'project_id','id');
    }

    public function owner()
    {
        return $this->belongsTo(User::class,'id','owner');
    }

    public function tiername()
    {
            return $this->hasOne(Tier::class,'id','tier');
    }
    public function envname()
    {
            return $this->hasOne(Environment::class,'id','tier');
    }


    public function firewalls()
    {
        return $this->hasMany(ProjectServerFirewall::class,'server_id','id');
    }

    public function securitygroups()
    {
        return $this->belongsToMany(ProjectSecurityGroupEnv::class, 'security_group_members');
    }



}
