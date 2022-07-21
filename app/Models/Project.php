<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory;
    protected $fillable = [
        'title', 'owner','created_at', 'updated_at', 'slug'
    ];

    protected $casts = [
        'created_at' => 'date:d-m-Y',
    ];
    public function server()
    {
        return $this->hasMany(ProjectServer::class,'project_id','id');
    }

    public function journey()
    {
        return $this->hasMany(ProjectJourney::class,'project_id','id');
    }

    public function owner()
    {
        return $this->hasone(User::class,'owner','id');
    }

    public function link($params = [])
    {
        return route('project.show', array_merge([$this->id,$this->slug], $params));
    }
    public function getProjectStatusAttribute()
    {
        if($this->status==1){
            return 'Draft';
        }
        if($this->status==2){
            return 'Review';
        }
        if($this->status==3){
            return 'Approve';
        }
        if($this->status==4){
            return 'In-Provisioning';
        }
        if($this->status==5){
            return 'Complete';
        }

    }
}
