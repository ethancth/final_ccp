<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProjectServerNetwork extends Model
{
    use HasFactory;

    public $fillable=[
        'server_id',
        'network_name',
        'network_ip',
        'created_by',
    ];
}
