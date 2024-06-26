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
        'is_asset_vm','price_actual','display_optional_sa','display_mandatory_sa',
        'provision_status',
        'provision_note',
        'provision_vra_workflow_id',
        'provision_datetime',
        'business_unit',
        'display_business_unit',
        'system_type',
        'display_system_type',
        'provision_hostname'
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

    public function systemtypename()
    {
        return $this->hasOne(SystemType::class,'id','system_type');
    }
    public function businessunitname()
    {
        return $this->hasOne(BusinessUnit::class,'id','business_unit');
    }

    public function network()
    {
        return $this->hasMany(ProjectServerNetwork::class,'server_id','id');
    }
    public function os()
    {
        return $this->hasOne(OperatingSystem::class,'id','operating_system');
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
