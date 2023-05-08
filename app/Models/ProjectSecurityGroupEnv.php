<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProjectSecurityGroupEnv extends Model
{
    use HasFactory;
    protected $fillable=['security_id','slug','env'];


    public function firewall()
    {
        return $this->hasMany(ProjectSecurityGroupEnvFirewall::class,'security_env_id','id');
    }

}
