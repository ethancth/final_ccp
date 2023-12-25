<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tenant extends Model
{
    use HasFactory;

    protected $fillable=['user_id','company_id','company_name','status','action',];

    public function company()
    {
        return $this->hasMany('App\Models\Company','id','company_id')->where('status', '=', '1');
    }
}
