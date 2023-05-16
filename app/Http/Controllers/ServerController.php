<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Models\FirewallService;
use App\Models\Project;
use App\Models\ProjectServer;
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
        return view('content/server/information', ['pageConfigs' => $pageConfigs,'breadcrumbs' => $breadcrumbs,'projectsecuritygroup'=>$_project_sercurity_group_env,'serverfirewallservice'=>$_serverfirewall,'firewallservice'=>$firewallservice, 'isprojectdropdown' =>$isprojectdropdown,'forms'=>$form,'costprofile'=>$costprofile], compact('server','costprofile'));
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
        $data  = ServerFirewallRules::where($where)->first();

        return response()->json($data);
    }

}
