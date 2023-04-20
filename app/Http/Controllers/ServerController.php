<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\ProjectServer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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
}
