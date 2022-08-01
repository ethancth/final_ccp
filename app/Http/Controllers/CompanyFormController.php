<?php

namespace App\Http\Controllers;

use App\Models\CostProfile;
use App\Models\Environment;
use App\Models\OperatingSystem;
use App\Models\Tier;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Facades\DataTables;

class CompanyFormController extends Controller
{
    //
    public function envform(Request $request)
    {

        $pageConfigs = ['pageHeader' => false,];
        $data= User::find(Auth::id())->company->envform;
        $formtxt='Environment';
        if ($request->ajax()) {
            $data = User::find(Auth::id())->company->envform;
            return Datatables::of($data)
//                ->addColumn('action', function($row){
//                    $btn = '<a href="javascript:void(0)" class="btn btn-primary btn-sm">View</a>';
//                    return $btn;
//                })
//                ->rawColumns(['action'])
                ->make(true);
        }
        $breadcrumbs = [
            ['link' => "/", 'name' => "Home"], ['link' => "management-environment", 'name' => "Environment Form"]
        ];

        return view('/content/management/env', ['pageConfigs' => $pageConfigs,'breadcrumbs' => $breadcrumbs,'data' => $data, 'formtxt' => $formtxt ,'pagetitle' =>'Form Configuration']);
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
                'company_id' => User::find(Auth::id())->company_id,
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
        return "";
    }

    //tier

    public function tierform(Request $request)
    {

        $pageConfigs = ['pageHeader' => false,];
        $data= User::find(Auth::id())->company->tierform;
        $formtxt='Tier';
        if ($request->ajax()) {
            $data = User::find(Auth::id())->company->tierform;
            return Datatables::of($data)
//                ->addColumn('action', function($row){
//                    $btn = '<a href="javascript:void(0)" class="btn btn-primary btn-sm">View</a>';
//                    return $btn;
//                })
//                ->rawColumns(['action'])
                ->make(true);
        }

        $breadcrumbs = [
            ['link' => "/", 'name' => "Home"], ['link' => "management-tier", 'name' => "Tier Form"]
        ];

        return view('/content/management/tier', ['pageConfigs' => $pageConfigs,'breadcrumbs' => $breadcrumbs,'data' => $data, 'formtxt' => $formtxt ,'pagetitle' =>'Form Configuration']);
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
                'company_id' => User::find(Auth::id())->company_id,
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
        return "";
    }

    //Operating System

    public function osform(Request $request)
    {

        $pageConfigs = ['pageHeader' => false,];
        $data= User::find(Auth::id())->company->tierform;
        $formtxt='Operating System';
        if ($request->ajax()) {
            $data = User::find(Auth::id())->company->osform;
            return Datatables::of($data)
//                ->addColumn('action', function($row){
//                    $btn = '<a href="javascript:void(0)" class="btn btn-primary btn-sm">View</a>';
//                    return $btn;
//                })
//                ->rawColumns(['action'])
                ->make(true);
        }
        $breadcrumbs = [
            ['link' => "/", 'name' => "Home"], ['link' => "management-os", 'name' => "Operating System Form"]
        ];

        return view('/content/management/os', ['pageConfigs' => $pageConfigs,'breadcrumbs' => $breadcrumbs,'data' => $data, 'formtxt' => $formtxt ,'pagetitle' =>'Form Configuration']);
    }

    public function os_request(Request $request)
    {
        //dd($request);
        OperatingSystem::updateOrCreate(
            [
                'id' => $request->form_id,
            ],
            [
                'name' => $request->basic_addon_name,
                'display_name' => $request->basic_default_display_name,
                'cost' => $request->basic_default_cost,
                'display_description' => $request->basic_default_desc,
                'display_icon' => $request->basic_default_icon,
                'display_icon_colour' => $request->select_colour,
                'company_id' => User::find(Auth::id())->company_id,
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
        return "";
    }

    public function costform()
    {
        $pageConfigs = ['pageHeader' => false,];
        $data= User::find(Auth::id())->company->costprofile->first();
        $breadcrumbs = [
            ['link' => "/", 'name' => "Home"], ['link' => "management-tier", 'name' => "Cost Form"]
        ];
        return view('/content/management/form', ['pageConfigs' => $pageConfigs,'breadcrumbs' => $breadcrumbs,'pagetitle' =>'Form Configuration','data' => $data]);
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
}
