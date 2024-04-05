<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Models\Environment;
use App\Models\FirewallService;
use App\Models\OperatingSystem;
use App\Models\ProjectFirewall;
use App\Models\ProjectFirewallPort;
use App\Models\ProjectSecurityGroup;
use App\Models\ProjectSecurityGroupEnv;
use App\Models\ProjectSecurityGroupEnvFirewall;
use App\Models\ProjectSecurityGroupFirewall;
use App\Models\ProjectServer;
use App\Models\Tier;
use App\Models\User;
use App\Models\VcVirtualMachine;
use Illuminate\Http\Request;
use App\Models\Project;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Yajra\DataTables\Facades\DataTables;
use function PHPUnit\Framework\isEmpty;

class ProjectController extends Controller
{
    //

    public function index(Request $request,Project $project)
    {

        if(request()->path()=='/'){
            return redirect('/project', 301);
        }



        $pageConfigs = ['pageHeader' =>true,'layoutWidth' => 'full'];
        //$project= User::find(Auth::id())->project;


        if ($request->ajax()) {

            if (Auth::user()->hasPermissionTo('approver_reject_level_1' )||Auth::user()->hasPermissionTo('approver_reject_level_2' ) ) {
                $data = $project->withStatus($request->status)
                    ->where('company_id','=',Auth::user()->company_id)
                    ->get();
            }else{
                $data = $project->withStatus($request->status)
                    ->where('owner','=',Auth()->id())
                    ->where('company_id','=',Auth::user()->company_id)
                    ->get();
            }

            return Datatables::of($data)
                ->addColumn('owner_name', function(Project $project) {
                    return  $project->ownername->name;
                })
                ->make(true);
        }



        return view('/content/project/project-home', ['pageConfigs' => $pageConfigs,'project' => $project]);
    }

    public function projectdestroy($id)
    {
        $project = Project::where('id', $id)->delete();
    }

    public function asset(Request $request,Project $project)
    {

        //dd($request);
        $pageConfigs = ['pageHeader' => false,];
        //$project= User::find(Auth::id())->project;
        $total_price = 0;
        $project1=$project->withStatus('complete')
            ->where('owner',Auth::id())
            ->each(function($p, $k) use (&$total_price) {
                $total_price += $p->server()->sum('price');
                $p->price=$total_price;
                $p->save();
            });



        if ($request->ajax()) {
            // dd($request);
            //$data = User::find(Auth::id())->project;
            $data = $project->withStatus('complete')
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

        return view('/content/project/asset', ['pageConfigs' => $pageConfigs,'project' => $project]);
    }

    public function sg(Project $project, Request $request){

        $projectsg=$project->sg()->get();
        if($projectsg->isEmpty()){
           $query= ProjectSecurityGroup::firstOrCreate(
                ['project_id' =>  $project->id],
                ['slug' => "SG-".$project->slug]
            );

           $query->save();
        }
        $projectsg=$project->sg()->get();
        $_project_g=$projectsg[0]->env()->get();
        $alltier=$project->server()->select('display_tier')->distinct()->pluck('display_tier')->toArray();



        if($_project_g->isEmpty()){

            foreach ($alltier as $field){
                $query= ProjectSecurityGroupEnv::firstOrCreate(
                    ['security_id' =>  $projectsg[0]->id,
                    'env' => $field,
                    'slug' => $projectsg[0]->slug.'-'.$field]

                );
            }
            $query->save();
        }

        foreach ($_project_g as $project_sg_env) {

            foreach ($project_sg_env->firewall as $row) {

                if($row->source=='Custom'){

                    $_row_array[] = [
                        'id' => $row->id,
                        'security_env_id' => $row->security_env_id,
                        'name' => $row->name,
                        'source' => '[IP]'.$row->display_source_custom_ip."   |   ".'[VM]'.$row->display_source_custom_vm.'   |   [SG]'.$row->display_source_custom_sg,
                        'destination' => $row->destination_name,
                        'port' => $row->display_port,
                        'status'=>$row->status,

                    ];

                }else{
                    $_row_array[] = [
                        'id' => $row->id,
                        'security_env_id' => $row->security_env_id,
                        'name' => $row->name,
                        'source' => $row->source,
                        'destination' => $row->destination_name,
                        'port' => $row->display_port,
                        'status'=>$row->status,

                    ];
                }


            }
            if (!isset($_row_array)) {
                // list is empty.

                $_section_array[] = [
                    'id' => $project_sg_env->id,
                    'slug' => $project_sg_env->slug,

                    'item'=>[]
                ];
            }else{
                $_section_array[] = [
                    'id' => $project_sg_env->id,
                    'slug' => $project_sg_env->slug,

                    'item'=>$_row_array
                ];
            }

            unset($_row_array);
        }

//        if ($request->ajax()) {
//            return $_section_array;
//        }

      //  dd($_section_array);
        $pageConfigs = ['pageHeader' => false,];
        $vcvm=ProjectServer::where('is_delete','=','0')->where('is_vm_provision','=','1')->get();

        return view('/content/project/project-sg-list', [
            'pageConfigs' => $pageConfigs,
            'pagetitle'=>$projectsg[0]->slug,
            'section_array'=>$_section_array,
            'vcvms' =>$vcvm,
            'projectsgs' => $_project_g

        ]);






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

    //get get_project_firewall
    public function get_project_firewall(Request $request){
        $_firewall= \App\Models\ProjectFirewall::find($request->id);
        return $_firewall;
    }

    //
    public function get_firewall_ports(Request $request)
    {
        $_firewall= \App\Models\ProjectFirewall::find($request->id);
        return $_firewall->firewallports;
    }


    public function create_project_firewall(Request $request){

//        dd($request);

     //   $_new_display_port=$this->get_display($request->modalPort,'FirewallService');
       // $_new_display_port_only=implode(',',array_unique($request->portserviceform));

        $_new_display_port=$this->get_display_port($request->portserviceform,'display');
        $_new_display_port_only=$this->get_display_port($request->portserviceform,'display1');



       // if($request->newSource=='custom'){

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
                $_source_vm = implode(',',$request->modalCustomVm);
            }else{

            }
            if($request->modalCustomSecurityGroup){
                $_new_display_custom_sg=$this->get_display($request->modalCustomSecurityGroup,'sg');
                $_source_sg = implode(',',$request->modalCustomSecurityGroup);
            }else{

            }

            if(!isset($request->modalCustomIP) && !isset($request->modalCustomVm)  && !isset($request->modalCustomSecurityGroup) ){
                $_source='ANY';
                $_firewall_name='[ANY]';
                $_source_type='ANY';
                $_source_ip='';
                $_new_display_custom_vm='';
                $_new_display_custom_sg='';
            }




//        }else{
//            $_source='ANY';
//            $_firewall_name='[ANY]';
//            $_source_type='ANY';
//            $_source_ip='';
//            $_new_display_custom_vm='';
//            $_new_display_custom_sg='';
//
//        }
        $_destination =ProjectSecurityGroupEnv::find($request->modalDestination);
//$_destination[0]->slug;

        $_id=ProjectFirewall::updateOrCreate(
            [
                'id' => $request->form_id,
            ],
            [
                'project_id' => $request->project_id,
                'firewall_name' => $_firewall_name,
                'source' => $_source,
                'source_type' => $_source,
                'destination_id' => $_destination[0]->id,
                'display_destination' => $_destination[0]->slug,
                'destination_name' => $_destination[0]->slug,
                'port' => $_new_display_port_only,
                'display_port' => $_new_display_port,
                'display_source_custom_ip' => $_source_ip,
                'display_source_custom_vm' => $_new_display_custom_vm,
                'display_source_custom_sg' => $_new_display_custom_sg,
                'source_source_custom_ip' => $_source_ip,
                'source_source_custom_vm' => $_source_vm,
                'source_source_custom_sg' => $_source_sg,

            ]
        );
        ProjectFirewallPort::where('project_firewall_id', '=', $_id->id)->delete();
        foreach($request->portserviceform as $value){


            if($value['portrange']==null){
                $is_all_port='1';

            }else{
                $is_all_port='0';
            }


            ProjectFirewallPort::create(
                [
                    'project_firewall_id' => $_id->id,
                    'port' => $value['portrange'],
                    'is_all_port' => $is_all_port,
                    'port_ref_id' =>  $_id->id,
                    'display_port_type' =>$value['type'],
                    'protocol' => $value['protocol'],

                ]);


        }


        return back()->with('success', 'Success！');
    }

    public function sg_store(Request $request){



        if( $request->basic_port_range==null){
            $_port='All ports';
        }else{
            $_port=$request->basic_port_range;
        }

        ProjectSecurityGroupEnvFirewall::updateOrCreate(
            [
                'id' => $request->form_id,
            ],
            [

                'security_env_id' => $request->security_env_id,
                'name' => $request->rule_name,
                'protocol' => $request->select_type,
                'port' => $_port,
                'type' => $request->select_type,
                'rule' => $request->select_rule_type,
                'status' => $request->select_status,
                'source' => $request->source,
                'destination' => $request->destination,

            ]
        );
        return back()->with('success', 'Success！');

}

    public function new_sg_store(Request $request){


        $_new_display_port=$this->get_display_port($request->portserviceform,'display');
        $_new_display_port_only=$this->get_display_port($request->portserviceform,'display1');


        if($request->newSource=='custom'){

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




        }else{
            $_source='ANY';
            $_firewall_name='[ANY]';
            $_source_type='ANY';
            $_source_ip='';
            $_new_display_custom_vm='';
            $_new_display_custom_sg='';

        }
        $_destination =ProjectSecurityGroupEnv::find($request->security_env_id);
//$_destination[0]->slug;

        ProjectSecurityGroupFirewall::updateOrCreate(
            [
                'id' => $request->form_id,
            ],
            [
                'security_env_id' => $request->security_env_id,
                'firewall_name' => $_firewall_name,
                'source' => $_source,
                'source_type' => $_source,
                'destination_id' => $_destination->id,
                'display_destination' => $_destination->slug,
                'destination_name' => $_destination->slug,
                'port' => $_new_display_port_only,
                'display_port' => $_new_display_port,
                'display_source_custom_ip' => $_source_ip,
                'display_source_custom_vm' => $_new_display_custom_vm,
                'display_source_custom_sg' => $_new_display_custom_sg,

            ]
        );
        return back()->with('success', 'Success！');

    }


    public function get_sg_env_firewall(Request $request){

        $where = array('id' => $request->id);
        $data  = ProjectSecurityGroupEnvFirewall::where($where)->first();

        return response()->json($data);
    }

    public function store(Project $project, Request $request)
    {
        $project->fill($request->all());
        $project->owner = Auth::id();
        $project->company_id = Auth::user()->company_id;
        $project->title = $request->modalProjectName;
        $project->status = 1;
        $project->save();
        //return redirect()->route('project.show', $project->id)->with('success', 'Success！');
        //dd($project->link())->with('success', 'Success！');
        return redirect()->to($project->link())->with('success', 'Project Created！');


    }
    public function submitproject(Request $request)
    {

        $project=Project::find($request->id);
        if($project->status=='1' && $project->server->count()>0){
            $project->status = 2;
            $project->save();
            return redirect()->to($project->link())->with('success', 'Project Submited！');
        }else{

            return redirect()->to($project->link())->with('warning', 'Project Submited unsuccessful！');
        }



    }

    public function rejectproject(Request $request)
    {
        $project=Project::find($request->id);
        if($project->status=='2'||$project->status=='3'){
            $project->status = 1;
            $project->save();
        }
        return redirect()->to($project->link())->with('success', 'Project Submited！');


    }

    public function approveproject(Request $request)
    {
        $project=Project::find($request->id);
        if($project->status=='2'){
            $project->status = 3;
            $project->save();
        }
        return redirect()->to($project->link())->with('success', 'Project Approved！');


    }

    public function approveprojectl2(Request $request)
    {

            $project = Project::find($request->id);
            if ($project->status == '3') {
                $project->status = 4;
                $project->save();
            }
            return redirect()->to($project->link())->with('success', 'Project Approved！');

    }

    public function show(Request $request,Project $project)
    {
        if ( !empty($project->slug) && $project->slug != $request->slug) {
            return redirect($project->link(), 301);
        }

       $pageConfigs = ['pageHeader' => true,];
        $projectservers=ProjectServer::where("project_id",$project->id)->orderByDesc("id")->get();
       // dd(Auth::user()->company->id);
       $form= Company::with('envform','tierform','osform','saform')->where('id','=',Auth::user()->company->id)->get();
      //  $firewallservice = FirewallService::where('status','1')->where('action','=','inbound')->get();
       //dd(Auth::user()->company->costprofile);
       $costprofile=Auth::user()->company->costprofile;
        $data =$project->server;
       // dump($data);
        if ($request->ajax()) {
            $data =$project->server;
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
            ['link' => "/", 'name' => "Home"], ['link' => "project", 'name' => "Project"], ['name' => $project->title],['name' => $project->getProjectStatusAttribute()]
        ];
        return view('content/project/project-detail', ['pageConfigs' => $pageConfigs,'breadcrumbs' => $breadcrumbs,'isprojectdropdown' =>$isprojectdropdown,'forms'=>$form,'costprofile'=>$costprofile], compact('projectservers','project','costprofile'));
    }

    public function assetshow(Request $request,Project $project)
    {
        if ( !empty($project->slug) && $project->slug != $request->slug) {
            return redirect($project->assetlink(), 301);
        }

        $pageConfigs = ['pageHeader' => true,];
        $projectservers=ProjectServer::where("project_id",$project->id)->orderByDesc("id")->get();
        // dd(Auth::user()->company->id);
        $form= Company::with('envform','tierform','osform','saform')->where('id','=',Auth::user()->company->id)->get();
        //$firewallservice = FirewallService::where('status','1')->where('action','=','inbound')->get();
        //dd(Auth::user()->company->costprofile);
        $costprofile=Auth::user()->company->costprofile;
        $projectfirewall=$project->firewall;
        $vcvm=ProjectServer::where('is_delete','=','0')->where('is_vm_provision','=','1')->get();
        $projectsg=$project->sg->env;
        $firewallservice=Auth::user()->company->firewallform;
        if ($request->ajax()) {
            $data =$project->server;
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
            ['link' => "/", 'name' => "Home"], ['link' => "project", 'name' => "Project"], ['name' => $project->title],['name' => $project->getProjectStatusAttribute()]
        ];
        return view('content/project/asset-project-detail-backup', ['firewallservices'=>$firewallservice,'projectsgs'=>$projectsg,'vcvms'=>$vcvm,'pageConfigs' => $pageConfigs,'breadcrumbs' => $breadcrumbs,'projectfirewall' => $projectfirewall,'firewallservice' => $firewallservice, 'isprojectdropdown' =>$isprojectdropdown,'forms'=>$form,'costprofile'=>$costprofile], compact('projectservers','project','costprofile'));
    }

    public function destroy(Request $request)
    {
        $ProjectServer = ProjectServer::where('id',$request->id)->delete();

        return response()->json(['success' => true]);
    }

    public function storeprojectsg(Request $request)
    {

        $sid=Project::find($request->_pid);
        ProjectSecurityGroupEnv::updateOrCreate(
            [
                'id' => $request->_id,
            ],
            [
                'security_id' => $sid->sg->id,
                'slug' => 'SG-'.$sid->slug.'-Custom-'.str::slug($request->name),
                'env' => 'Custom',
                'scope' => 'env',
                'can_delete' => '1',

            ]);
        return back()->with('success', 'Success！');
    }

    public function storeserver(ProjectServer $projectserver, Request $request)
    {
        //TODO price can be modify from client side
        $find_os_icon=OperatingSystem::find($request->operating_system);
        //$find_tier=OperatingSystem::find($request->operating_system);
       // dd($request);
        if($request->server_id)
        {
            $_check_server=ProjectServer::find($request->server_id);
            if($_check_server->env == 1){
                $find_tier=Tier::find(1);
                $find_env=Environment::find(1);
                $request->tier=1;
                $request->environment=1;
            }else{
                $find_tier=Tier::find($_check_server->tier);
                $find_env=Environment::find($_check_server->environment);
                $request->tier=$_check_server->tier;
                $request->environment=$_check_server->tier;
            }
        }else{
            $find_tier=Tier::find(1);
            $find_env=Environment::find(1);
            $request->tier=1;
            $request->environment=1;
        }

        $Array_mandatory = explode(',', $request->sa_m);

        $sas = DB::table('service_applications')->whereIn('id', $Array_mandatory)->get();
        $_new_name='';
        foreach($sas as $sa){
            $_new_name.=$sa->display_name.", ";
        }
        $display_mandatory=substr($_new_name, 0, -2);


        $Array_optional = explode(',', $request->sa_o);

        $sas = DB::table('service_applications')->whereIn('id', $Array_optional)->get();
        $_new_name='';
        foreach($sas as $sa){
            $_new_name.=$sa->display_name.", ";
        }
        $display_optional=substr($_new_name, 0, -2);

        ProjectServer::updateOrCreate(
            [
                'id' => $request->server_id
            ],
            [
                'project_id' => $request->project_id,
                'hostname' => preg_replace('/\s+/', '', $request->hostname),
                'environment' => $request->environment,
                'tier' => $request->tier,
                'price' => $request->cost,
                'price_actual' => $request->cost,
                'operating_system' => $request->operating_system,
                'operating_system_option' => $find_os_icon->display_icon,
                'display_env' => $find_env->display_name,
                'display_tier' => $find_tier->display_name,
                'display_os' => $find_os_icon->display_name,
                'v_cpu' => $request->v_cpu,
                'v_memory' => $request -> v_memory,
                'total_storage' => $request->total_storage,
                'mandatory_sa_field' => $request->sa_m,
                'display_mandatory_sa' => $display_mandatory,
                'optional_sa_field' => $request->sa_o,
                'display_optional_sa' => $display_optional,
                'owner' => Auth::id(),
            ]);
        return redirect()->route('project.show', $request->project_id)->with('success', 'Success！');


    }

    public function edit(Request $request)
    {
        $where = array('id' => $request->id);
        $server  = ProjectServer::where($where)->first();

        return response()->json($server);
    }


}
