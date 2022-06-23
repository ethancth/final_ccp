<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Models\Project;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Facades\DataTables;

class ProjectController extends Controller
{
    //

    public function index(Request $request)
    {

        $pageConfigs = ['pageHeader' => false,];
        $project= User::find(Auth::id())->project;

        if ($request->ajax()) {
            $data = User::find(Auth::id())->project;
            return Datatables::of($data)
//                ->addColumn('action', function($row){
//                    $btn = '<a href="javascript:void(0)" class="btn btn-primary btn-sm">View</a>';
//                    return $btn;
//                })
//                ->rawColumns(['action'])
                ->make(true);
        }

        return view('/content/project/project-home', ['pageConfigs' => $pageConfigs,'project' => $project]);
    }

    public function store(Project $project, Request $request)
    {
        $project->fill($request->all());
        $project->owner = Auth::id();
        $project->title = $request->modalProjectName;
        $project->save();
        return redirect()->route('project')->with('success', 'Success！');


    }

    public function show(Request $request,Project $project)
    {
       $pageConfigs = ['pageHeader' => true,];
        $breadcrumbs = [
            ['link' => "/", 'name' => "Home"], ['link' => "javascript:void(0)", 'name' => "Project"], ['name' => $project->title]
        ];
        return view('content/project/project-detail', ['pageConfigs' => $pageConfigs,'breadcrumbs' => $breadcrumbs], compact('project'));
    }

    public function getEthanFunnyAttribute()
    {
        return "EHE";
    }

}
