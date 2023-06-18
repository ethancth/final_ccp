<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProjectSecurityGroupEnv extends Model
{
    use HasFactory;
    protected $fillable=['security_id','slug','env','scope','can_delete'];


    public function firewall()
    {
        return $this->hasMany(ProjectSecurityGroupFirewall::class,'security_env_id','id');
    }

    public function servers()
    {
        return $this->belongsToMany(ProjectServer::class, 'security_group_members');
    }

    public function projectfirewall()
    {
        return $this->hasMany(ProjectFirewall::class,'destination_id','id');
    }

}
