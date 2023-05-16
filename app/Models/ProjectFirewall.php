<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProjectFirewall extends Model
{
    use HasFactory;
    protected $fillable =[
        'project_id',
        'firewall_name',
        'firewall_uuid',
        'source',
        'source_type',
        'destination_id',
        'destination_name',
        'port',
        'is_custom_port',
        'status',
    ];


}
