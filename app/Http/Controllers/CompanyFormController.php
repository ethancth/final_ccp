<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Models\CostProfile;
use App\Models\Environment;
use App\Models\FormPolicy;
use App\Models\OperatingSystem;
use App\Models\ServiceApplication;
use App\Models\Tier;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Yajra\DataTables\Facades\DataTables;

class CompanyFormController extends Controller
{
    //
    public function envform(Request $request)
    {
        $pageConfigs = ['pageHeader' => false,];
        $data= Auth::user()->company->envform;
        $formtxt='Environment';
        if ($request->ajax()) {
            $data = Auth::user()->company->selectenvform;
            return Datatables::of($data)
//                ->addColumn('action', function($row){
//                    $btn = '<a href="javascript:void(0)" class="btn btn-primary btn-sm">View</a>';
//                    return $btn;
//                })
//                ->rawColumns(['action'])
                ->make(true);
        }
        $breadcrumbs = [
            ['link' => "/", 'name' => "Home"], ['link' => "management-environment", 'name' => "Environments"]
        ];

        return view('/content/management/env', ['pageConfigs' => $pageConfigs,'breadcrumbs' => $breadcrumbs,'data' => $data, 'formtxt' => $formtxt ,'pagetitle' =>'Environments']);
    }

    public function env_request(Request $request)
    {
        //dd($request);
        Environment::updateOrCreate(
            [
                'id' => $request->form_id,
            ],
            [
                'name' => $request->basic_addon_name,
                'display_name' => $request->basic_default_display_name,
                'display_description' => $request->basic_default_desc,
                'display_icon' => $request->basic_default_icon,
                'display_icon_colour' => $request->select_colour,
                'company_id' => Auth::user()->company_id,
                'status' => $request->select_status,
            ]);
        return redirect()->route('management_env')->with('success', 'Success！');
    }

    public function env_edit(Request $request)
    {
        $where = array('id' => $request->id);
        $env  = Environment::where($where)->first();

        return response()->json($env);
    }
    public function env_delete(Request $request)
    {
        $this->company_policy();
        $result=Environment::where('id','=',$request->id)->where('company_id','=',Auth::user()->company_id)->delete();

        return true;
    }

    public function company_policy(){
        $_company=company::find(User::find(Auth::user()->company_id))->first();

        if($_company->master_id===Auth::id()){

        }else{
            abort(403,"You don't have permission to access / on this server.");
        }
    }

    //tier

    public function tierform(Request $request)
    {

        $pageConfigs = ['pageHeader' => false,];
        $data= Auth::user()->company->tierform;
        $formtxt='Cluster';
        if ($request->ajax()) {
            $data = Auth::user()->company->selecttierform;
            return Datatables::of($data)
//                ->addColumn('action', function($row){
//                    $btn = '<a href="javascript:void(0)" class="btn btn-primary btn-sm">View</a>';
//                    return $btn;
//                })
//                ->rawColumns(['action'])
                ->make(true);
        }

        $breadcrumbs = [
            ['link' => "/", 'name' => "Home"], ['link' => "management-tier", 'name' => "Cluster"]
        ];

        return view('/content/management/tier', ['pageConfigs' => $pageConfigs,'breadcrumbs' => $breadcrumbs,'data' => $data, 'formtxt' => $formtxt ,'pagetitle' =>'Tiers']);
    }

    public function tier_request(Request $request)
    {
        //dd($request);
        Tier::updateOrCreate(
            [
                'id' => $request->form_id,
            ],
            [
                'name' => $request->basic_addon_name,
                'display_name' => $request->basic_default_display_name,
                'display_description' => $request->basic_default_desc,
                'display_icon' => $request->basic_default_icon,
                'display_icon_colour' => $request->select_colour,
                'company_id' => Auth::user()->company_id,
                'status' => $request->select_status,
            ]);
        return redirect()->route('management_tier')->with('success', 'Success！');
    }

    public function tier_edit(Request $request)
    {
        $where = array('id' => $request->id);
        $env  = Tier::where($where)->first();

        return response()->json($env);
    }
    public function tier_delete(Request $request)
    {
        $this->company_policy();
        $result=Tier::where('id','=',$request->id)->where('company_id','=',Auth::user()->company_id)->delete();

        return true;
    }

    //Operating System

    public function osform(Request $request)
    {

        $pageConfigs = ['pageHeader' => false,];
       // $data= Auth::user()->company->tierform;
        $formtxt='Operating System';
        if ($request->ajax()) {
            $data = Auth::user()->company->osform;
            return Datatables::of($data)
//                ->addColumn('action', function($row){
//                    $btn = '<a href="javascript:void(0)" class="btn btn-primary btn-sm">View</a>';
//                    return $btn;
//                })
//                ->rawColumns(['action'])
                ->make(true);
        }
        $breadcrumbs = [
            ['link' => "/", 'name' => "Home"], ['link' => "management-os", 'name' => "Operating Systems"]
        ];

        return view('/content/management/os', ['pageConfigs' => $pageConfigs,'breadcrumbs' => $breadcrumbs, 'formtxt' => $formtxt ,'pagetitle' =>'Operating System']);
    }

    public function os_request(Request $request)
    {
        $os_window_icon='windows';
        $os_window_icon_color='windows';
        $os_rhel_icon='rhel';
        $os_rhel_icon_color='rhel';
        $os_centos_icon='centos';
        $os_centos_icon_color='centos';
        $os_other_icon='other';
        $os_other_icon_color='other';
        //dd($request);
        if($request->select_os_platform=='windows'){
            $_icon=$os_window_icon;
            $_icon_color=$os_window_icon_color;

        }elseif($request->select_os_platform=='centos'){
            $_icon=$os_centos_icon;
            $_icon_color=$os_centos_icon_color;
        }elseif($request->select_os_platform=='rhel'){
                $_icon=$os_rhel_icon;
                $_icon_color=$os_rhel_icon_color;
        }else{
                $_icon=$os_other_icon;
                $_icon_color=$os_other_icon_color;

        }
        OperatingSystem::updateOrCreate(
            [
                'id' => $request->form_id,
            ],
            [
                'name' => $request->basic_addon_name,
                'display_name' => $request->basic_default_display_name,
                'cost' => $request->basic_default_cost,
                'display_description' => $request->basic_default_desc,
                'display_icon' => $_icon,
                'display_icon_colour' => $_icon_color,
                'company_id' => Auth::user()->company_id,
                'status' => $request->select_status,
            ]);
        return redirect()->route('management_os')->with('success', 'Success！');
    }

    public function os_edit(Request $request)
    {
        $where = array('id' => $request->id);
        $env  = OperatingSystem::where($where)->first();

        return response()->json($env);
    }
    public function os_delete(Request $request)
    {
        $this->company_policy();
        $result=OperatingSystem::where('id','=',$request->id)->where('company_id','=',Auth::user()->company_id)->delete();

        return true;
    }

    //Service Application

    public function saform(Request $request)
    {

        $pageConfigs = ['pageHeader' => false,];
        $data= Auth::user()->company->saform;
        $formtxt='Application Services';
        if ($request->ajax()) {
            $data = Auth::user()->company->saform;
            return Datatables::of($data)
//                ->addColumn('action', function($row){
//                    $btn = '<a href="javascript:void(0)" class="btn btn-primary btn-sm">View</a>';
//                    return $btn;
//                })
//                ->rawColumns(['action'])
                ->make(true);
        }
        $breadcrumbs = [
            ['link' => "/", 'name' => "Home"], ['link' => "management-service-application", 'name' => "Application Services"]
        ];

        return view('/content/management/service_application', ['pageConfigs' => $pageConfigs,'breadcrumbs' => $breadcrumbs,'data' => $data, 'formtxt' => $formtxt ,'pagetitle' =>'Application Services']);
    }

    public function sa_request(Request $request)
    {
        if( $request->select_satype==1){
            $select_satype_one_time=1;
            $select_satype_cost_per_core=0;
            $reset_number=0;
        }else{
            $select_satype_one_time=0;
            $select_satype_cost_per_core=1;
            $reset_number=$request->basic_default_cost_per_core;
        }
        ServiceApplication::updateOrCreate(
            [
                'id' => $request->form_id,
            ],
            [
                'name' => $request->basic_addon_name,
                'display_name' => $request->basic_default_display_name,
                'cost' => $request->basic_default_cost,
                'display_description' => $request->basic_default_desc,
                'company_id' => Auth::user()->company_id,
                'status' => $request->select_status,
                'is_one_time_payment' => $select_satype_one_time,
                'is_cost_per_core' => $select_satype_cost_per_core,
                'cpu_amount' =>$reset_number,
            ]);
        return redirect()->route('management_sa')->with('success', 'Success！');
    }

    public function sa_edit(Request $request)
    {
        $where = array('id' => $request->id);
        $env  = ServiceApplication::where($where)->first();

        return response()->json($env);
    }

    public function sa_delete(Request $request)
    {
        $this->company_policy();
        $result=ServiceApplication::where('id','=',$request->id)->where('company_id','=',Auth::user()->company_id)->delete();

        return true;
    }


    // cost profile
    public function costform()
    {
        $pageConfigs = ['pageHeader' => false,];
        $data= Auth::user()->company->costprofile->first();
        $breadcrumbs = [
            ['link' => "/", 'name' => "Home"], ['link' => "management-cost", 'name' => "Cost Profile"]
        ];
        return view('/content/management/form', ['pageConfigs' => $pageConfigs,'breadcrumbs' => $breadcrumbs,'pagetitle' =>'Cost Profile','data' => $data]);
    }

    public function companyform_store(Request $request)
    {
        Company::updateOrCreate(
            [
                'id' => Auth()->user()->company_id,
            ],
            [
                'name' => $request->company_name,
                'domain' =>str::slug($request->company_domain,'-'),
                'slug' =>str::slug($request->company_domain,'-'),
                'default_password' => $request->default_password,
                'mandatory_field' => $request->form_group_a,
                'is_new_company' => '1'
            ]);
        return redirect()->route('project')->with('success', 'Success！');

    }
    public function costform_store(Request $request)
    {



        CostProfile::updateOrCreate(
            [
                'id' => $request->form_id,
            ],
            [
                'name' => $request->name,
                'description' =>$request->description,
                'vcpu_price' => $request->vcpu_price,
                'vmen_price' => $request->vmen_price,
                'vstorage_price' => $request->vstorage_price,
                'form_vcpu_min' => $request->form_vcpu_min,
                'form_vcpu_max' => $request->form_vcpu_max,
                'form_vmen_min' => $request->form_vmen_min,
                'form_vmen_max' => $request->form_vmen_max,
                'form_vstorage_min' => $request->form_vstorage_min,
                'form_vstorage_max' => $request->form_vstorage_max,
            ]);
        return redirect()->route('management_cost')->with('success', 'Success！');
    }

    //policyForm

    public function policyform(Request $request)
    {
        $pageConfigs = ['pageHeader' => false,];
        $policyform= Auth::user()->company->policyform;
        $envform=Auth::user()->company->selectenvform;
        $tierform=Auth::user()->company->selecttierform;
        $osform=Auth::user()->company->osform;
        $saform=Auth::user()->company->saform;

        $_input_env=1;
        $_input_tier=1;
        $_input_os=1;


        if ($request->ajax()) {
            $data = Auth::user()->company->policyform;
            return Datatables::of($data)
                ->addColumn('envname', function(FormPolicy $formpolicy) {
                    return  $formpolicy->envname->display_name;
                })
                ->addColumn('tiername', function(FormPolicy $formpolicy) {
                    return  $formpolicy->tiername->display_name;
                })
                ->addColumn('osname', function(FormPolicy $formpolicy) {
                    return  $formpolicy->osname->display_name;
                })

                ->make(true);
        }
        $breadcrumbs = [
            ['link' => "/", 'name' => "Home"], ['link' => "management-policy-form", 'name' => "Policies"]
        ];

        return view('/content/management/policy_home', ['pageConfigs' => $pageConfigs,'breadcrumbs' => $breadcrumbs,'policyform' => $policyform,'envforms'=>$envform,'tierforms'=>$tierform,'osforms'=>$osform,'saforms'=>$saform]);
    }

    public function policyform_destroy(Request $request)
    {

        $record=FormPolicy::find($request->value);

        if ($record) {
            $record->delete();

        }
    }
    public function policyform_store(Request $request)
    {
        //dd($request);
        if($request->form_group_a==null && $request->form_group_b==null){
            return redirect()->route('management_policyform')->with('warning', 'Service Application is Required to drag to Optional or Mandatory group！');
        }
        $demo = DB::table('form_policies')
            ->where('env_field', '=', "$request->modalFormEnv")
            ->where('tier_field', '=', "$request->modalFormTier")
            ->Where('os_field', '=', "$request->modalFormOs")
            ->get();

        $Array_mandatory = explode(',', $request->form_group_a);

        $sas = DB::table('service_applications')->whereIn('id', $Array_mandatory)->get();
        $_new_name='';
        foreach($sas as $sa){
            $_new_name.=$sa->display_name.", ";
        }
        $display_mandatory=substr($_new_name, 0, -2);


        $Array_optional = explode(',', $request->form_group_b);

        $sas = DB::table('service_applications')->whereIn('id', $Array_optional)->get();
        $_new_name='';
        foreach($sas as $sa){
            $_new_name.=$sa->display_name.", ";
        }
        $display_optional=substr($_new_name, 0, -2);



        if($demo->isEmpty()){
            FormPolicy::updateOrCreate(
                [
                    'id' => $request->form_id,
                ],
                [
                    'env_field' => $request->modalFormEnv,
                    'tier_field' =>$request->modalFormTier,
                    'os_field' => $request->modalFormOs,
                    'mandatory_field' => $request->form_group_a,
                    'optional_field' => $request->form_group_b,
                    'display_optional' => $display_optional,
                    'display_mandatory' => $display_mandatory,
                    'company_id' => Auth::user()->company_id,
                ]);
            return redirect()->route('management_policyform')->with('success', 'Success！');
        }else{
            return redirect()->route('management_policyform')->with('warning', 'Condition is exist！');
        }

    }

    //ajax datafilter

    public function getMandatoryService(Request $request)
    {
        //dd($request);

        $env= $request->env;
        $tier= $request->tier;
        $os= $request->os;

        $company_id=Auth::user()->company->id;
       // echo $form = "Environment = ".$env."<p>Tier =".$tier."<p>OS =".$os."<p>Company ID =".$company_id;

         $resule= DB::table('form_policies')
             ->where('tier_field',$tier)
             ->where('os_field',$os)
             ->where('env_field', $env)
             ->where('company_id',$company_id)
         ->exists();

        if(!$resule){

            //echo "got no data";
            //optional data
            $resuleB=DB::table('service_applications')
                ->where('company_id',$company_id)
                ->get();
            $resuleM=NULL;
            $a=array('name'=>'','id'=>'');

        }else{
            //echo "got data";
            $resule= DB::table('form_policies')
                ->where('tier_field',$tier)
                ->where('os_field',$os)
                ->where('env_field', $env)
                ->where('company_id',$company_id)
                ->get();
            $data=$resule[0]->optional_field;
            $data2=$resule[0]->mandatory_field;
            $resuleB= DB::table('service_applications')
            ->whereIn('id',explode(',', $data))
            ->get();
            $resuleM= DB::table('service_applications')
                ->whereIn('id',explode(',', $data2))
                ->get();
            $newName="";
            $newID="";
            foreach ($resuleM as $resule) {
                $newName.= $resule->display_name.", ";
                $newID.= $resule->id.",";
            }
            $resuleName=substr($newName, 0, -2);
            $resuleID=substr($newID, 0, -1);
            $a=array('name'=>$resuleName,'id'=>$resuleID);

        }

        if($request->ftype=='getMandatory'){
            return $resuleM;
        }elseif($request->ftype=='getMandatoryField'){
            return $a;
        }elseif($request->ftype=='getMandatoryID'){
            return $a;
        }elseif($request->ftype=='getOptional'){
            return $resuleB;
        }

    }

    public function getServiceName(Request $request)
    {
       // echo "yahaha";
        //echo $a=$request->sa;
        // $new=implode("",$request->sa);
        //echo print_r($a);
      //echo substr($a, 0, -1);
        //dd($request);

//        $company_id=$request->pid;

        $company_id=Auth::user()->company->id;
        // echo $form = "Environment = ".$env."<p>Tier =".$tier."<p>OS =".$os."<p>Company ID =".$company_id;

       $myArray = explode(',', $request->sa);
////        //echo $myArray;
        $sas = ServiceApplication::select("display_name")
            ->whereIn('id', $myArray)
            ->get();
        //dd($sas);
        $_new_name='';
        foreach($sas as $sa){
            $_new_name.=$sa->display_name." ,";
        }
        $resuleName=substr($_new_name, 0, -2);
        return $a=array('name'=>$resuleName);


    }
    public function get_os_disk(Request $request)
    {
       // dump($request);
        $_get_os_type=OperatingSystem::find($request->os);
        if($_get_os_type->os_type=='windows'){

            if($request->mem<=24){
                $va = 150;
            }else{
                $va=  round($request->mem +4,-1)+150;

            }

        }else{

            if($request->mem<=32){
                $va =  170;
            }else{
                $va =   round($request->mem +4,-1)+170;
            }
        }
        return array('disk'=>$va);

    }
    //project server cost

    public function getCost(Request $request){

        $company_id=Auth::user()->company->id;
        $company_cost_profile=Auth::user()->company->costprofile->first();

        //resource cost
        $_cost_vcpu=($request->cpu/$company_cost_profile->vcpu)*$company_cost_profile->vcpu_price;
        $_cost_memory=($request->mem/$company_cost_profile->vmen)*$company_cost_profile->vmen_price;
        $_cost_storage=($request->storage  /$company_cost_profile->vstorage)*$company_cost_profile->vstorage_price;
        $_cost_os=OperatingSystem::find($request->os);




        ///////////////////////////////////////////////////////
        $resule= DB::table('form_policies')
            ->where('tier_field',$request->tier)
            ->where('os_field',$request->os)
            ->where('env_field', $request->env)
            ->where('company_id',$company_id)
            ->exists();

        if(!$resule){
            $sam=NULL;
        }else{
            $resule= DB::table('form_policies')
                ->where('tier_field',$request->tier)
                ->where('os_field',$request->os)
                ->where('env_field', $request->env)
                ->where('company_id',$company_id)
                ->get();
            $sam=$resule[0]->mandatory_field;

        }
         $sam=$sam.','.$request->sao;
        ///////////////////////////////////////////////////////
        $resuleB= DB::table('service_applications')
            ->whereIn('id',explode(',', $sam))
            ->get();
       // dump($resuleB);
        $_total_cost_sam=0;
        $_formula_sa='Formula '."<br/>";
        foreach($resuleB as $services){

            if($services->is_one_time_payment){
                $_total_cost_sam=$_total_cost_sam+$services->cost;
            }elseif($services->is_cost_per_core){

                if($request->cpu % $services->cpu_amount==0){
                    $_cost_sam= ($request->cpu / $services->cpu_amount)*$services->cost;
                    $_formula_sa.='('.$request->cpu.'/'.$services->cpu_amount.')*'.$services->cost;
                }else{
                    $_cost_sam= floor($request->cpu / $services->cpu_amount+1)*$services->cost;
                    $_formula_sa.='('.$request->cpu.'/'.($services->cpu_amount+1).')*'.$services->cost;
                }
                $_total_cost_sam=$_total_cost_sam+$_cost_sam;

            }

//            echo $request->cpu;
//            echo $services->name;

        }
        //
//        $_cost_vcpu=($request->cpu/$company_cost_profile->vcpu)*$company_cost_profile->vcpu_price;
//        $_cost_memory=($request->mem/$company_cost_profile->vmen)*$company_cost_profile->vmen_price;
//        $_cost_storage=($request->storage  /$company_cost_profile->vstorage)*$company_cost_profile->vstorage_price;


        $_formula_cpu="CPU = (".$request->cpu.'/'.$company_cost_profile->vcpu.')*'.$company_cost_profile->vcpu_price.'='.$_cost_vcpu.')';
        $_formula_memory="Memory = (".$request->mem.'/'.$company_cost_profile->vmen.')*'.$company_cost_profile->vmen_price.'='.$_cost_memory.')';
        $_formula_storage="Storage = (".$request->storage.'/'.$company_cost_profile->vstorage.')*'.$company_cost_profile->vstorage_price.'='.$_cost_storage.')';

         $_total_cost_sam= number_format((float)$_total_cost_sam, 5, '.', '');

         $_formula_os=
        $_total_cost_server=$_cost_vcpu+$_cost_memory+$_cost_storage+$_total_cost_sam+$_cost_os->cost;
      //  dump($_cost_vcpu,$_cost_memory,$_cost_storage,$_total_cost_server);
        //return number_format((float)$_total_cost_server, 2, '.', '');
        return $a=array(
            'cost'=>number_format((float)$_total_cost_server, 2, '.', ''),
            'CPU'=>$_formula_cpu,
            'memory'=>$_formula_memory,
            'storage'=>$_formula_storage,
            'fomula_sa'=>$_formula_sa,
        );


    }



}
