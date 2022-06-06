<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CostPaymentProfile extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
    ];
}
