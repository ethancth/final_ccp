<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProjectSecurityGroupFirewall extends Model
{
    use HasFactory;
    protected $fillable =[
        'security_env_id',
        'firewall_name',
        'firewall_uuid',
        'source',
        'source_type',
        'destination_id',
        'destination_name',
        'port',
        'is_custom_port',
        'status',

        'display_source_custom_vm',
        'display_source_custom_sg',
        'display_source_custom_ip',
        'display_destination',
        'display_port',
        'editable',
    ];
}
