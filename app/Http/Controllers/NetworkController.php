<?php

namespace App\Http\Controllers;

use App\Models\VcNetwork;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\DataTables;

class NetworkController extends Controller
{
    //

    public function show_network(Request $request)
    {
        $pageConfigs = ['pageHeader' => false,];
        // $data= Auth::user()->company->tierform;
        $formtxt='Network';
        if ($request->ajax()) {
            $data = VcNetwork::all();
            return Datatables::of($data)
//                ->addColumn('action', function($row){
//                    $btn = '<a href="javascript:void(0)" class="btn btn-primary btn-sm">View</a>';
//                    return $btn;
//                })
//                ->rawColumns(['action'])
                ->make(true);
        }
        $breadcrumbs = [
            ['link' => "/", 'name' => "Home"], ['link' => "management-network", 'name' => "Network"]
        ];

        return view('/content/management/network', ['pageConfigs' => $pageConfigs,'breadcrumbs' => $breadcrumbs, 'formtxt' => $formtxt ,'pagetitle' =>'Network']);

    }

    public function sync_network(){

        VcNetwork::truncate();
        app('App\Http\Controllers\AriaController')->trigger_workflow();
        header('refresh:5;url=' . url('home'));

        return back()->with('success','success');

    }

}
