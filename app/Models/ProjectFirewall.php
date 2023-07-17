<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProjectFirewall extends Model
{
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

       'display_source_custom_vm',
'display_source_custom_sg',
'display_source_custom_ip',
'display_destination',
'display_port',
'editable',
    ];

    //this have many firewallport

    public function firewallports(){
        return $this->hasMany(ProjectFirewallPort::class,'project_firewall_id','id');
    }


}
