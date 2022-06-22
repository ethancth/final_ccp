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
    public function server()
    {
        return $this->hasMany(ProjectServer::class,'project_id','id');
    }

    public function journey()
    {
       // return $this->hasone(ProjectJourney::class,'project_id','id');
    }

    public function owner()
    {
        return $this->hasone(User::class,'owner','id');
    }
}
