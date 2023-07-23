<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Models\FirewallService;
use App\Models\Project;
use App\Models\ProjectFirewallPort;
use App\Models\ProjectSecurityGroupEnv;
use App\Models\ProjectServer;
use App\Models\ProjectServerFirewall;
use App\Models\ProjectServerFirewallPort;
use App\Models\ServerFirewallRules;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Yajra\DataTables\Facades\DataTables;

class ServerController extends Controller
{
    //

    public function index(Request $request, ProjectServer $projectserver)
    {

        $pageConfigs = ['pageHeader' => false,];
        //$project= User::find(Auth::id())->project;
        $project=$projectserver->where('is_vm_provision','1')
            ->where('owner',Auth::id())
            ->get();

        if ($request->ajax()) {
            // dd($request);
            //$data = User::find(Auth::id())->project;
            $data = $projectserver->where('is_vm_provision','1')
                ->where('owner',Auth::id())
                ->get();
            return Datatables::of($data)
//                ->addColumn('action', function($row){
//                    $btn = '<a href="javascript:void(0)" class="btn btn-primary btn-sm">View</a>';
//                    return $btn;
//                })
//                ->rawColumns(['action'])
                ->make(true);
        }

        return view('/content/server/server-home', ['pageConfigs' => $pageConfigs,'project' => $project]);
    }

    public function firewall(Request $request,ProjectServer $server)
    {

        $pageConfigs = ['pageHeader' => true,];
        // dd(Auth::user()->company->id);
        $form= Company::with('firewallserviceform')->where('id','=',Auth::user()->company->id)->get();
        //dd(Auth::user()->company->costprofile);
        $costprofile=Auth::user()->company->costprofile;
        if ($request->ajax()) {
            $data =$server->firewall;
            //dd($data);
            return Datatables::of($data)
//                ->addColumn('action', function($row){
//                    $btn = '<a href="javascript:void(0)" class="btn btn-primary btn-sm">View</a>';
//                    return $btn;
//                })
//                ->rawColumns(['action'])
                ->make(true);
        }
        $isprojectdropdown=true;
        $breadcrumbs = [
            ['link' => "/", 'name' => "Home"], [ 'name' =>  $server->hostname], ['name' => 'Firewall Rules']
        ];
        return view('content/server/server-firewall-list', ['pageConfigs' => $pageConfigs,'breadcrumbs' => $breadcrumbs, 'isprojectdropdown' =>$isprojectdropdown,'forms'=>$form,'costprofile'=>$costprofile], compact('server','costprofile'));
    }

    public function information(Request $request,ProjectServer $server)
    {

        $pageConfigs = ['pageHeader' => true,];
        // dd(Auth::user()->company->id);
        $form= Company::with('firewallserviceform')->where('id','=',Auth::user()->company->id)->get();
        $firewallservice = FirewallService::where('status','1')->where('action','=','inbound')->get();
        //dd(Auth::user()->company->costprofile);
        $costprofile=Auth::user()->company->costprofile;
        $_serverfirewall=ServerFirewallRules::where('server_id','=',$server->id)->get();


        $_all_available_vm=ProjectServer::where('is_delete','=','0')->where('is_vm_provision','=','1')->get();
        $firewallservice=Auth::user()->company->firewallform;
        //get project security rule

        $_project_sercurity_group_env=$server->project->sg->env;

        if ($request->ajax()) {
            $data =$server->firewall;
            //dd($data);
            return Datatables::of($data)
//                ->addColumn('action', function($row){
//                    $btn = '<a href="javascript:void(0)" class="btn btn-primary btn-sm">View</a>';
//                    return $btn;
//                })
//                ->rawColumns(['action'])
                ->make(true);
        }
        $isprojectdropdown=true;
        $breadcrumbs = [
           [ 'name' =>  'Server','link' => "/server"],[ 'name' =>  $server->hostname], ['name' => 'Server Information']
        ];
        return view('content/server/information', ['firewallservices' =>$firewallservice,'vcvms'=>$_all_available_vm,'projectsgs'=>$_project_sercurity_group_env,'pageConfigs' => $pageConfigs,'breadcrumbs' => $breadcrumbs,'projectsecuritygroup'=>$_project_sercurity_group_env,'serverfirewallservice'=>$_serverfirewall,'firewallservice'=>$firewallservice, 'isprojectdropdown' =>$isprojectdropdown,'forms'=>$form,'costprofile'=>$costprofile], compact('server','costprofile'));
    }

    public function firewall_request(Request $request, ProjectServer $server)
    {


        $projectserver=ProjectServer::find($request->server_id);
        if( $request->basic_port_range==null){
            $_port='All ports';
        }else{
            $_port=$request->basic_port_range;
        }


        ServerFirewallRules::updateOrCreate(
            [
                'id' => $request->form_id,
            ],
            [
                'server_id' => $request->server_id,
                'protocol' => 'TCP',
                'port' => $_port,
                'action' => 'Inbound',
                'status' => 'Allow',
                'source' => $request->source,
                'destination' => $projectserver->hostname,

            ]
        );

        return redirect()->back()->with('success', 'Success！');

    }

    public function firewall_request_edit(Request $request){

        $where = array('id' => $request->id);
        $data  = ProjectServerFirewall::where($where)->first();

        return response()->json($data);
    }

    public function firewall_request_get(Request $request)
    {
        $_firewall= \App\Models\ProjectServerFirewall::find($request->id);
        return $_firewall->firewallports;
    }




    //////
    ///
    ///
    ///
    ///
    ///
    ///
    ///
    ///
    ///

    public function create_server_firewall(Request $request,ProjectServer $server){


        //   $_new_display_port=$this->get_display($request->modalPort,'FirewallService');
        // $_new_display_port_only=implode(',',array_unique($request->portserviceform));

        $_new_display_port=$this->get_display_port($request->portserviceform,'display');
        $_new_display_port_only=$this->get_display_port($request->portserviceform,'display1');



            $_source='Custom';
            $_firewall_name='[Custom]';
            $_source_type='Custom';
            $_source_ip='';
            $_source_vm='';
            $_source_sg='';
            $_new_display_custom_vm='';
            $_new_display_custom_sg='';



            if($request->modalCustomIP){
                $_source_ip = implode(',',array_unique($request->modalCustomIP));
            }

            if($request->modalCustomVm){
                $_new_display_custom_vm=$this->get_display($request->modalCustomVm,'vm');
                $_source_vm = $request->modalCustomVm;
            }
            if($request->modalCustomSecurityGroup){
                $_new_display_custom_sg=$this->get_display($request->modalCustomSecurityGroup,'sg');
                $_source_sg = $request->modalCustomSecurityGroup;
            }

            if(!isset($request->modalCustomIP) && !isset($request->modalCustomVm)  && !isset($request->modalCustomSecurityGroup) ){
                $_source='ANY';
                $_firewall_name='[ANY]';
                $_source_type='ANY';
                $_source_ip='';
                $_new_display_custom_vm='';
                $_new_display_custom_sg='';
            }




        $_destination =$request->server_id;
//$_destination[0]->slug;

        $_id=ProjectServerFirewall::updateOrCreate(
            [
                'id' => $request->form_id,
            ],
            [
                'server_id' => $server->id,
                'firewall_name' => $_firewall_name,
                'source' => $_source,
                'source_type' => $_source,
                'destination_id' => $server->id,
                'display_destination' => $server->hostname,
                'destination_name' => $server->hostname,
                'port' => $_new_display_port_only,
                'display_port' => $_new_display_port,
                'display_source_custom_ip' => $_source_ip,
                'display_source_custom_vm' => $_new_display_custom_vm,
                'display_source_custom_sg' => $_new_display_custom_sg,

            ]
        );

        ProjectServerFirewallPort::where('project_server_firewall_id', '=', $_id->id)->delete();
        foreach($request->portserviceform as $value){


            if($value['portrange']==null){
                $is_all_port='1';

            }else{
                $is_all_port='0';
            }


            ProjectServerFirewallPort::create(
                [
                    'project_server_firewall_id' => $_id->id,
                    'port' => $value['portrange'],
                    'is_all_port' => $is_all_port,
                    'port_ref_id' =>  $_id->id,
                    'display_port_type' =>$value['type'],
                    'protocol' => $value['protocol'],

                ]);


        }
        return back()->with('success', 'Success！');
    }

    public function get_display_port($param,$type){

        if($type=='display'){
            $new_value='';
            foreach ($param as $value) {
                if($value['type']!='custom')
                {
                    $new_value.= strtoupper($value['type']).',';
                }else{
                    if($value['portrange']==null){
                        $new_value.= strtoupper($value['protocol']).' - All Port,';
                    }else{
                        $new_value.= strtoupper($value['protocol']).' - '.$value['portrange'].',';
                    }


                }

            }
            return  substr($new_value, 0, -1);
        }else{
            $new_value='';
            foreach ($param as $value) {
                if($value['type']!='custom')
                {
                    $new_value.= strtoupper($value['portrange']).',';
                }else{
                    if($value['portrange']==null){
                        $new_value.= '0 - 99999,';
                    }else{
                        $new_value.=$value['portrange'].',';
                    }


                }

            }

            return  substr($new_value, 0, -1);
        }

    }

    public function get_display($param, $class){
        $_new_array='';
        foreach(array_unique($param) as $array)
        {

            if($class=='FirewallService'){
                $_array=FirewallService::where('port','=',$array)->get();
            }

            if($class=='vm'){
                $_array=ProjectServer::where('id','=',$array)->get();
            }

            if($class=='sg'){
                $_array=ProjectSecurityGroupEnv::where('id','=',$array)->get();
            }


            if(count($_array)>='1')
            {

                if($class=='FirewallService'){
                    $_new_array.=$_array[0]->type.',';
                }

                if($class=='vm'){
                    $_new_array.=$_array[0]->hostname.',';
                }
                if($class=='sg'){
                    $_new_array.=$_array[0]->slug.',';
                }
            }else{
                $_new_array.=$array.',';
            }


        }
        return substr($_new_array, 0, -1);
    }

}
