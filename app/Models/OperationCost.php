<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OperationCost extends Model
{
    use HasFactory;
    protected $fillable = [
        'name', 'description','profile', 'profile_type', 'cost',
        'start_from', 'end_from','create_by','cost_method'
    ];
}
