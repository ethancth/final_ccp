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

    public function index(Request $request,Project $project)
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
        //return redirect()->route('project.show', $project->id)->with('success', 'Success！');
        //dd($project->link())->with('success', 'Success！');
        return redirect()->to($project->link())->with('success', 'Project Created！');


    }

    public function show(Request $request,Project $project)
    {
        if ( !empty($project->slug) && $project->slug != $request->slug) {
            return redirect($project->link(), 301);
        }

       $pageConfigs = ['pageHeader' => true,];
        $projectservers=ProjectServer::where("project_id",$project->id)->orderByDesc("id")->get();
       // $projectservers=$project->server;
        if ($request->ajax()) {
            $data =$project->server;
            //dd($data);
            return Datatables::of($data)
//                ->addColumn('action', function($row){
//                    $btn = '<a href="javascript:void(0)" class="btn btn-primary btn-sm">View</a>';
//                    return $btn;
//                })
//                ->rawColumns(['action'])
                ->make(true);
        }
        $isprojectdropdown=true;
        $breadcrumbs = [
            ['link' => "/", 'name' => "Home"], ['link' => "project", 'name' => "Project"], ['name' => $project->title],['name' => $project->getProjectStatusAttribute()]
        ];
        return view('content/project/project-detail', ['pageConfigs' => $pageConfigs,'breadcrumbs' => $breadcrumbs, 'isprojectdropdown' =>$isprojectdropdown], compact('projectservers','project'));
    }

    public function destroy(Request $request)
    {
        $ProjectServer = ProjectServer::where('id',$request->id)->delete();

        return response()->json(['success' => true]);
    }

    public function storeserver(ProjectServer $projectserver, Request $request)
    {

//        $projectserver->fill($request->all());
//        $projectserver->owner = Auth::id();
//        $projectserver->save();
        //dd($request);
        ProjectServer::updateOrCreate(
            [
                'id' => $request->server_id
            ],
            [
                'project_id' => $request->project_id,
                'hostname' => $request->hostname,
                'environment' => $request->environment,
                'tier' => $request->tier,
                'operating_system' => $request->operating_system,
                'operating_system_option' => $request->operating_system_option,
                'v_cpu' => $request->v_cpu,
                'v_memory' => $request -> v_memory,
                'total_storage' => $request->total_storage,
                'owner' => Auth::id(),
            ]);
        return redirect()->route('project.show', $request->project_id)->with('success', 'Success！');


    }

    public function edit(Request $request)
    {
        $where = array('id' => $request->id);
        $server  = ProjectServer::where($where)->first();

        return response()->json($server);

    }


}
