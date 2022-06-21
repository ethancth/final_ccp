<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory;
    protected $fillable = [
        'title', 'owner','created_at', 'updated_at'
    ];

    protected $casts = [
        'created_at' => 'date:d-m-Y',
    ];
    public function vm()
    {
     //   return $this->hasMany(ProjectVm::class,'project_id','id');
    }

    public function journey()
    {
       // return $this->hasone(ProjectJourney::class,'project_id','id');
    }

    public function owner()
    {
        return $this->hasone(User::class,'id','owner');
    }
}
