<?php

namespace App\Http\Controllers;

use App\Models\ProjectServer;
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
        $project->status = 1;
        $project->save();
        return redirect()->route('project.show', $project->id)->with('success', 'Success！');


    }

    public function show(Request $request,Project $project)
    {
       $pageConfigs = ['pageHeader' => true,];
        if ($request->ajax()) {
            $data =$project->server;
            return Datatables::of($data)
//                ->addColumn('action', function($row){
//                    $btn = '<a href="javascript:void(0)" class="btn btn-primary btn-sm">View</a>';
//                    return $btn;
//                })
//                ->rawColumns(['action'])
                ->make(true);
        }
        $breadcrumbs = [
            ['link' => "/", 'name' => "Home"], ['link' => "project", 'name' => "Project"], ['name' => $project->title]
        ];
        return view('content/project/project-detail', ['pageConfigs' => $pageConfigs,'breadcrumbs' => $breadcrumbs], compact('project'));
    }

    public function storeserver(ProjectServer $projectserver, Request $request)
    {

        $projectserver->fill($request->all());
        $projectserver->owner = Auth::id();
        $projectserver->save();
        return redirect()->route('project.show', $projectserver->project_id)->with('success', 'Success！');


    }


}
