<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProjectSecurityGroupEnvFirewall extends Model
{
    use HasFactory;

    public $fillable =[
        'security_env_id',
        'security_id',
        'name',
        'source',
        'destination',
        'port',
        'protocol',
        'rule',
        'status'
        ];


}
