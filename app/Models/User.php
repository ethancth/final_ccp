<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use  HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'company_id',
        'introduction',
        'department_id',
        'is_teamlead',
        'profile_photo_path'

    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function getAvatarAttribute()
    {
        return \Avatar::create($this->name)->toBase64();
    }
    public function department()
    {
        //return $this->hasOne('App\Models\Department','department_id');
        return $this->hasone('App\Models\Department', 'id', 'department_id');

    }
    public function project()
    {
        return $this->hasMany('App\Models\Project','owner','id')->where('is_delete', '=', '0');
    }

    public function is_department_hod()
    {
        return $this->hasone('App\Models\Department', 'id', 'department_id')->where('hod_id','=',$this->id);
    }

    public function setNameAttribute($value)
    {
        $this->attributes['name'] = strtolower($value);
    }
    public function server()
    {
        return $this->hasMany(ProjectServer::Class,'owner', 'id');
    }
    public function company()
    {
        return $this->belongsTo(Company::class, 'company_id', 'id');
    }

    public function teamlead()
    {
        return $this->belongsToMany(Company::class, 'teamleads', 'user_id', 'company_id');
    }
    public function isteamlead()
    {
        return $this->teamlead()->where('status', '1')->exists();
    }



}
