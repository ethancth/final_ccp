<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FirewallService extends Model
{
    use HasFactory;

    protected $fillable =[
        'uuid',
        'name',
        'source',
        'destination',
        'port',
        'action',
        'status'
    ];
}
