<?php

namespace App\Http\Controllers;

use App\Models\FirewallService;
use App\Models\ProjectSecurityGroupEnv;
use Illuminate\Http\Request;

class ProjectSecurityGroupController extends Controller
{
    //

    public function getpsg_member(Request $request)
    {
        dd($request);
    }

    public function getpsg_member_store(Request $request)
    {
        //dd($request);
        $sg=ProjectSecurityGroupEnv::find($request->form_firewall_group_id);
        if($request->customSwitchOverwrite){
            $sg->servers()->sync($request->CustomVm);
        }else{
            $sg->servers()->syncWithoutDetaching($request->CustomVm);
        }
        return back()->with('success', 'Success add member to security Group！');


    }

    public function getservice(Request $request)
    {


        $_security_group=ProjectSecurityGroupEnv::find($request->id);
        return $_security_group->servers()->get();
    }

}
