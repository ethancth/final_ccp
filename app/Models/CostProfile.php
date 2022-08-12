<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CostProfile extends Model
{
    use HasFactory;
    protected $fillable = [
        'name', 'description', 'vcpu','vcpu_price','vmen_price', 'vmen','h_vcpu_price','h_vmen_price','form_vcpu_min','form_vcpu_max','form_vmen_min','form_vmen_max','form_vstorage_min','form_vstorage_max',''
    ];

    public function company()
    {
        return $this->hasOne(Company::class,'id','company_id');
    }

}
