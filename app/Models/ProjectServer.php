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
        'total_storage','operating_system_option'
    ];

    public function project()
    {
        return $this->belongsTo(Project::class,'id','project_id');
    }

    public function owner()
    {
        return $this->belongsTo(User::class,'id','owner');
    }

    public function 
}
