<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ServerFirewallRules extends Model
{
    use HasFactory;

    protected $fillable =[
        'server_id',
        'type',
        'protocol',
        'source',
        'destination',
        'port',
        'action',
        'status'
    ];

    public function firewallrules()
    {
        return $this->hasMany(ServerFirewallRules::class,'server_id','id');
    }

    public function server(){
        return $this->belongsTo(ProjectFirewall::class,'server_id','id');
    }
}
