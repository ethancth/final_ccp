<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CostProfile extends Model
{
    use HasFactory;
    protected $fillable = [
        'name', 'description', 'vcpu','vcpu_price','vmen_price', 'vmen','h_vcpu_price','h_vmen_price',
    ];
}
