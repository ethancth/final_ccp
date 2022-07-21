<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'status',
        'phone',
    ];

    public function user()
    {
       return $this->hasMany(User::class,'company_id','id');
    }

    public function teamleader()
    {
        return '';
    }

    public function teamlead()
    {
        return $this->belongsToMany(User::class, 'teamleads', 'company_id', 'user_id');
    }

    public function addteamlead($user_ids)
    {
        if ( ! is_array($user_ids)) {
            $user_ids = compact('user_ids');
        }
        $this->teamlead()->sync($user_ids, false);
    }
    public function removeteamlead($user_ids)
    {
        if ( ! is_array($user_ids)) {
            $user_ids = compact('user_ids');
        }
        $this->teamlead()->detach($user_ids);
    }


}
