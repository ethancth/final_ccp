<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProjectServerFirewallPort extends Model
{
    use HasFactory;

    protected $fillable =[
        'project_server_firewall_id',
        'port',
        'is_all_port',
        'port_ref_id',
        'display_port_type',
        'protocol'
    ];
}
