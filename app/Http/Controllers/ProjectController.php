<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Models\Environment;
use App\Models\OperatingSystem;
use App\Models\ProjectServer;
use App\Models\Tier;
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
    public function submitproject(Request $request)
    {
        $project=Project::find($request->id);
        if($project->status=='1'){
            $project->status = 2;
            $project->save();
        }
        return redirect()->to($project->link())->with('success', 'Project Submited！');


    }

    public function rejectproject(Request $request)
    {
        $project=Project::find($request->id);
        if($project->status=='2'||$project->status=='3'){
            $project->status = 1;
            $project->save();
        }
        return redirect()->to($project->link())->with('success', 'Project Submited！');


    }

    public function approveproject(Request $request)
    {
        $project=Project::find($request->id);
        if($project->status=='2'){
            $project->status = 3;
            $project->save();
        }
        return redirect()->to($project->link())->with('success', 'Project Approved！');


    }

    public function show(Request $request,Project $project)
    {
        if ( !empty($project->slug) && $project->slug != $request->slug) {
            return redirect($project->link(), 301);
        }

       $pageConfigs = ['pageHeader' => true,];
        $projectservers=ProjectServer::where("project_id",$project->id)->orderByDesc("id")->get();
       // dd(Auth::user()->company->id);
       $form= Company::with('envform','tierform','osform','saform')->where('id','=',Auth::user()->company->id)->get();
       //dd(Auth::user()->company->costprofile);
       $costprofile=Auth::user()->company->costprofile;
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
        return view('content/project/project-detail', ['pageConfigs' => $pageConfigs,'breadcrumbs' => $breadcrumbs, 'isprojectdropdown' =>$isprojectdropdown,'forms'=>$form,'costprofile'=>$costprofile], compact('projectservers','project','costprofile'));
    }

    public function destroy(Request $request)
    {
        $ProjectServer = ProjectServer::where('id',$request->id)->delete();

        return response()->json(['success' => true]);
    }

    public function storeserver(ProjectServer $projectserver, Request $request)
    {
        //TODO price can be modify from client side
        $find_os_icon=OperatingSystem::find($request->operating_system);
        $find_tier=Tier::find($request->tier);
        $find_env=Environment::find($request->environment);
        //$find_tier=OperatingSystem::find($request->operating_system);
        ProjectServer::updateOrCreate(
            [
                'id' => $request->server_id
            ],
            [
                'project_id' => $request->project_id,
                'hostname' => remove_spacing($request->hostname),
                'environment' => $request->environment,
                'tier' => $request->tier,
                'price' => $request->cost,
                'operating_system' => $request->operating_system,
                'operating_system_option' => $find_os_icon->display_icon,
                'display_env' => $find_env->display_name,
                'display_tier' => $find_tier->display_name,
                'display_os' => $find_os_icon->display_name,
                'v_cpu' => $request->v_cpu,
                'v_memory' => $request -> v_memory,
                'total_storage' => $request->total_storage,
                'mandatory_sa_field' => $request->sa_m,
                'optional_sa_field' => $request->sa_o,
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
