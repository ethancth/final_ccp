<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ServiceApplication extends Model
{
    use HasFactory;
    protected $fillable=['name','display_name','display_description','company_id','status','is_one_time_payment','cost','is_cost_per_core','cpu_amount','is_default'];

    protected $casts = [
        'created_at' => 'date:d-m-Y',
    ];

    public function company()
    {
        return $this->belongsTo(Company::class,'id','company_id');
    }
}
