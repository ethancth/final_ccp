<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'status',
        'phone',
        'slug',
        'domain',
        'master_id',
        'is_new_company',
        'default_password'
    ];

    public function user()
    {
       return $this->hasMany(User::class,'company_id','id');
    }

    public function tenantuser()
    {
        return $this->hasManyThrough(User::class,Tenant::class,'company_id','id','id','user_id')->where('status','=',1);
    }

    public function teamleader()
    {
        return '';
    }

    public function infraconnector()
    {
        return $this->hasMany(InfraConnector::class,'company_id','id');
    }

    public function department()
    {
        return $this->hasMany(Department::class,'company_id','id');
    }

    public function teamlead()
    {
        return $this->belongsToMany(User::class, 'teamleads', 'company_id', 'user_id');
    }

    public function addteamlead($user_ids)
    {
        if ( ! is_array($user_ids)) {
            $user_ids = compact('user_ids');
        }
        $this->teamlead()->sync($user_ids, false);
    }
    public function removeteamlead($user_ids)
    {
        if ( ! is_array($user_ids)) {
            $user_ids = compact('user_ids');
        }
        $this->teamlead()->detach($user_ids);
    }

    public function envform()
    {
        return $this->hasMany(Environment::class,'company_id','id');
    }

    public function tierform()
    {
        return $this->hasMany(Tier::class,'company_id','id');
    }
    public function osform()
    {
        return $this->hasMany(OperatingSystem::class,'company_id','id');
    }

    public function costprofile()
    {
        return $this->hasMany(CostProfile::class,'company_id','id');
    }

    public function saform()
    {
        return $this->hasMany(ServiceApplication::class,'company_id','id');
    }

    public function firewallserviceform()
    {
        return $this->hasMany(FirewallService::class,'company_id','id');
    }

    public function policyform()
    {
        return $this->hasMany(FormPolicy::class,'company_id','id');
    }

    public function firewallform()
    {
        return $this->hasMany(FirewallService::class,'company_id','id');
    }


}
