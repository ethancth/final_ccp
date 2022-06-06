<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProjectVm extends Model
{
    use HasFactory;
    protected $fillable = [
        'project_id','operating_system',
        'v_cpu','v_memory','environment','tier',
        'hostname', 'owner','created_at', 'updated_at',
        'total_storage'
    ];

    public function project()
    {
        return $this->hasOne(Project::class,'id','project_id');
    }
}
