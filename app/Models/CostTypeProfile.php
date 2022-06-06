<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CostTypeProfile extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
    ];

    public function operationcost()
    {
        return $this->belongsTo('App\Models\OperationCost', 'profile');
    }
}
