<?php

namespace App\Http\Controllers;

use App\Models\Environment;
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

        return view('/content/management/home', ['pageConfigs' => $pageConfigs,'breadcrumbs' => $breadcrumbs,'data' => $data, 'formtxt' => $formtxt ,'pagetitle' =>'Form Configuration']);
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
}
