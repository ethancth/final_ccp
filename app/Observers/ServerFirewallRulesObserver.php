<?php

namespace App\Observers;

use App\Models\ServerFirewallRules;
use Illuminate\Support\Str;

class ServerFirewallRulesObserver
{
    //

    public function created(ServerFirewallRules $serverFirewallRules)
    {

        $serverFirewallRules->type= str::slug($serverFirewallRules->server->project->slug . '-' . $serverFirewallRules->server->hostname . '-' . Str::random(10));
        $serverFirewallRules->save();
    }

    public function saving(ServerFirewallRules $serverFirewallRules)
    {

        if(!$serverFirewallRules->type){
            $serverFirewallRules->type= str::slug($serverFirewallRules->server->project->slug . '-' . $serverFirewallRules->server->hostname . '-' . Str::random(10));
            $serverFirewallRules->save();
        }

    }


}
