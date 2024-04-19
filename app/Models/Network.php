<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Network extends Model
{

    public $attributes=[
        'network_name','subnet','dns1','dns2','status'
    ];
}
