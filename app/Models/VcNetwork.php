<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class VcNetwork extends Model
{
    use HasFactory;

    public $fillable=[
        'vlanid',
        'dv_switch',
        'name',
        'cluster',
        'status',
    ];

}
