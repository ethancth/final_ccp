<?php

namespace App\Http\Controllers;

use App\Models\InfraConnector;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\DataTables;

class InfraController extends Controller
{
    //

    public function connector(Request $request)
    {
        $pageConfigs = ['pageHeader' => false,];
        $data= Auth::user()->company->infraconnector;
        $formtxt='Connector';
        $pagetitle1='Connector';
        $pagetitle2='Infrastructure Site Connector';
        if ($request->ajax()) {
            $data = Auth::user()->company->infraconnector;

            return Datatables::of($data)
//                ->addColumn('action', function($row){
//                    $btn = '<a href="javascript:void(0)" class="btn btn-primary btn-sm">View</a>';
//                    return $btn;
//                })
//                ->rawColumns(['action'])
                ->make(true);
        }
        $breadcrumbs = [
            ['link' => "/", 'name' => "Home"], ['link' => "management-infrastructure-connector", 'name' => "Connector"]
        ];

        return view('/content/infra/connector', ['pageConfigs' => $pageConfigs,'breadcrumbs' => $breadcrumbs,'data' => $data, 'formtxt' => $formtxt ,'pagetitle' =>'Infra','pagetitle1' =>$pagetitle1,'pagetitle2' =>$pagetitle2]);
    }


    public function connector_store(Request $request)
    {
        InfraConnector::updateOrCreate(
            [
                'id' => $request->form_id,
            ],
            [
                'display_name' => $request->basic_addon_name,
                'server_address' => $request->fqdn,
                'credential' => $request->basic_default_icon,
                'display_icon_colour' => $request->select_colour,
                'company_id' => Auth::user()->company_id,
                'status' => $request->select_status,
            ]);
        return redirect()->route('infra.connector')->with('success', 'Success！');
    }

    public function connector_edit(Request $request)
    {
        $where = array('id' => $request->id);
        $env  = InfraConnector::where($where)->first();

        return response()->json($env);
    }
}


