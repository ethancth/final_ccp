<?php

namespace App\Http\Controllers;

use App\Models\FirewallService;
use App\Models\ServiceApplication;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Facades\DataTables;

class FirewallServiceControler extends Controller
{
    //

    public function index(Request $request)
    {

        $pageConfigs = ['pageHeader' => false,];
        $data= Auth::user()->company->saform;
        $formtxt='Service Application';
        if ($request->ajax()) {
            $data = Auth::user()->company->firewallserviceform;
            return Datatables::of($data)
//                ->addColumn('action', function($row){
//                    $btn = '<a href="javascript:void(0)" class="btn btn-primary btn-sm">View</a>';
//                    return $btn;
//                })
//                ->rawColumns(['action'])
                ->make(true);
        }
        $breadcrumbs = [
            ['link' => "/", 'name' => "Home"], ['link' => "management-firewall-services", 'name' => "Firewall Services"]
        ];

        return view('/content/management/firewallservices/index', ['pageConfigs' => $pageConfigs,'breadcrumbs' => $breadcrumbs,'data' => $data, 'formtxt' => $formtxt ,'pagetitle' =>'Form Configuration']);
    }

    public function store(Request $request)
    {

        if( $request->basic_port_range==null){
            $_port='All ports';
        }else{

            $_port=$request->basic_port_range;
        }
        if($request->select_rule_type=='Outbound'){
            $_source='';
            $_destination=$request->basic_source_destination;
        }
        if($request->select_rule_type=='Inbound'){
            $_source=$request->basic_source_destination;
            $_destination='';
        }
        FirewallService::updateOrCreate(
            [
                'id' => $request->form_id,
            ],
            [
                'type' => $request->basic_addon_name,
                'protocol' => $request->select_type,
                'port' => $_port,
                'action' => $request->select_rule_type,
                'company_id' => Auth::user()->company_id,
                'status' => $request->select_status,
                'source' => $_source,
                'destination' => $_destination,

            ]
        );
//        ServiceApplication::updateOrCreate(
//            [
//                'id' => $request->form_id,
//            ],
//            [
//                'name' => $request->basic_addon_name,
//                'display_name' => $request->basic_default_display_name,
//                'cost' => $request->basic_default_cost,
//                'display_description' => $request->basic_default_desc,
//                'company_id' => Auth::user()->company_id,
//                'status' => $request->select_status,
//                'is_one_time_payment' => $select_satype_one_time,
//                'is_cost_per_core' => $select_satype_cost_per_core,
//                'cpu_amount' =>$reset_number,
//            ]);
        return redirect()->route('management_firewall_service')->with('success', 'Success！');
    }

    public function edit(Request $request)
    {
        $where = array('id' => $request->id);
        $env  = FirewallService::where($where)->first();

        return response()->json($env);
    }
}
