<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProjectSecurityGroup extends Model
{
    use HasFactory;

    protected $fillable=['project_id','slug'];

    public function env()
    {
        return $this->hasMany(ProjectSecurityGroupEnv::class,'security_id','id');
    }
}
