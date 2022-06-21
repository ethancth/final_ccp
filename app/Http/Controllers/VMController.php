<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\Vmtable;
use App\Models\Department;
use Auth;
use Spatie\Permission\Models\Role;
use App\Models\User;
use App\Helpers\Helper;

//set_time_limit(0);
class VMController extends Controller
{
    //$datastore_cost_profile->created_by = Auth::id();
    public function table(){
        //$this->calvmcost();
        //$values=Cluster::with('costprofile')->with('department')->get();

        //$vms=Department::with('vm')->where('vm_cpu','<>','')->where('is_template','false')->where('sync_status', 1)->get();
        //$u_id= Auth::id();

        //dd(User::find(Auth::id())->hasRole('HOD'));


            $vms = Vmtable::with('cluster')
                ->where('vm_cpu','<>','')
                ->where('is_template','false')
                ->where('sync_status', 1)
                //->where('cluster_id',$u_id->domain_id)
                ->get();




            $u_id= User::find(Auth::id())->is_department_hod;
            if($u_id==null){


                $datavm=User::find(Auth::id())->vm()->allRelatedIds()->toArray();

                $vms = Vmtable::with('cluster')->wherein('vm_id',$datavm)->where('sync_status',1)->get();




            }else{
                //TODO 1 HOD with multipler cluster
                //IS HOD
                $u_id= User::find(Auth::id())->department->cluster->first();
                $domain_id=$u_id->department_id;
                //$user->department->cluster;
                //$u_id='IS HOD';
                $vms = Vmtable::with('cluster')
                    ->where('vm_cpu','<>','')
                    ->where('is_template','false')
                    ->where('sync_status', 1)
                    ->where('cluster_id',$u_id->domain_id)
                    ->get();

            }







        $breadcrumbs = [
            ['link'=>"dashboard-analytics",'name'=>"Home"], ['name'=> 'Virtual Machine']
        ];

        return view('/content/virtualmachine/list', [
            'breadcrumbs' => $breadcrumbs
        ], compact('vms'));
    }

    public function display_vm_all_history(){
        notify()->success('We do have the Kapua suite available.', 'Turtle Bay Resort', ['timeOut' => 5000]);
        if(Auth::user()->hasRole('VIP')){
            $vms = Vmtable::with('cluster')
                ->where('vm_cpu','<>','')
                ->where('is_template','false')
                ->where('sync_status', 1)
                //->where('cluster_id',$u_id->domain_id)
                ->get();

            //daily vm cost
            $sql = "select count(id) as 'total',COALESCE(SUM(f_vm_cost),0) as vm_cost,COALESCE(SUM(f_vcpu_price),0) as vm_cpu_cost,COALESCE(SUM(f_vmen_price),0) as vm_vmem_cost,COALESCE(SUM(f_vstorage_price),0) as vm_vstorage_cost,date_format(created_at,'%Y-%m-%d') as date from vmtables group by date_format(created_at,'%Y-%m-%d') order by date desc ";
            $vms=Helper::custom_query($sql);



        }

        $pageConfigs = [
            'pageHeader' => false
        ];

        $breadcrumbs = [
            ['link'=>"dashboard-analytics",'name'=>"Home"], ['name'=> 'Virtual Machine']
        ];

        return view('/pages/virtualmachine/all', [
            'breadcrumbs' => $breadcrumbs
        ], compact('vms'));


    }


    public function calvmcost(){
        $vms =  Vmtable::All();
        $vms_daily_cost=0;
        foreach ($vms as $r) {
            //load live record only
            if($r->sync_status){

                //get cost from cost profile
                $_vcpu_price=$r->cluster->costprofile->h_vcpu_price;
                $_vmen_price=$r->cluster->costprofile->h_vmen_price;
                //$_vstorage_price=$r->cluster->costprofile->h_vstorage_price;

                //datastorehandle

                $r_vms=$r->vmdatastore;
                //load all vmdatastore
                $_total_ds_cost=0;
                $_h_storage=0;
                foreach ($r_vms as $r_vm) {
                    if($r_vm->sync_status) {

                        $r_vm_cost = DB::table('datastores')
                            ->select('h_vstorage_price')
                            ->join('datastore_cost_profiles', 'datastore_cost_profiles.id', '=', 'datastores.cost_profile_id')
                            ->where('datastores.sync_status', '1')
                            ->where('datastores.ds_id', $r_vm->ds_id)

                            ->paginate(1)->first();

                        $current_totalstorage = $r_vm->ds_unshared + $r_vm->ds_uncommitted;
                        $_h_storage = $r_vm_cost->h_vstorage_price;



                        $_total_ds_cost = $_total_ds_cost + ($current_totalstorage * $_h_storage);


                    }
                }




                //this resouce value
                $_vcpu=intval(str_replace(' vCPUs','',$r->vm_cpu));
                $_men=intval(str_replace(' MB','',$r->vm_men));
                $_men=$_men/1024;
                $_vstorage=number_format($r->storage_usage, 2, '.', ',');

                //calculater
                $f_vcpu=$_vcpu_price*$_vcpu;
                $f_vmen=$_vmen_price*$_men;
                //$f_vstorage=$_vstorage_price*$_vstorage;
                $f_vstorage=$_total_ds_cost;


                if($r->is_template=='true'){
                    $f_cost=$f_vstorage;
                    $f_vcpu=0;
                    $f_vmen=0;


                }else{
                    $f_cost=$f_vcpu+$f_vmen+$f_vstorage;
                }
                // $vms_daily_cost=$vms_daily_cost+$f_cost;
                $vms_daily_cost=$vms_daily_cost+$f_vcpu;

                \DB::transaction(function () use ( $r,$f_cost,$_h_storage,$f_vcpu,$f_vmen,$f_vstorage) {




                    $r->update([
                        'h_vcpu'            => $r->cluster->costprofile->vcpu,
                        'h_vcpu_price'      => $r->cluster->costprofile->vcpu_price,
                        'h_vmen'            => $r->cluster->costprofile->vmen,
                        'h_vmen_price'      => $r->cluster->costprofile->vmen_price,
                        'h_vstorage'        => $r->cluster->costprofile->vstorage,
                        'h_vstorage_price'  => $_h_storage,
                        'h_vstorage_unit'   => $r->cluster->costprofile->vstorage_unit,
                        'f_vm_cost'         => $f_cost,
                        'f_vcpu_price'      => $f_vcpu,
                        'f_vmen_price'      => $f_vmen,
                        'f_vstorage_price'  => $f_vstorage,

                    ]);



                });

                $f_cost=0;





            }

        }
        DB::table('daily_cost')->insert(
            ['daily_cost' => $vms_daily_cost,'created_at'=>now()]
        );



    }
}
