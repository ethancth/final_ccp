<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProjectServerFirewall extends Model
{
    use HasFactory;
    protected $fillable =[
        'server_id',
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

    public function firewallports(){
        return $this->hasMany(ProjectServerFirewallPort::class,'project_server_firewall_id','id');
    }

}
