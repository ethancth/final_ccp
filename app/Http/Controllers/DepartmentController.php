<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Models\Department;
use App\Models\DepartmentMember;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Yajra\DataTables\DataTables;
use function PHPUnit\Framework\isEmpty;
use function PHPUnit\Framework\isNull;

class DepartmentController extends Controller
{
    //

    public function show(Request $request)
    {

        $pageConfigs = ['pageHeader' => false,];
        $data= Auth::user()->company->department;
        $formtxt='Department';
        if ($request->ajax()) {
            $data = Auth::user()->company->department;
            return Datatables::of($data)
//                ->addColumn('action', function($row){
//                    $btn = '<a href="javascript:void(0)" class="btn btn-primary btn-sm">View</a>';
//                    return $btn;
//                })
//                ->rawColumns(['action'])
                ->make(true);
        }

        $all_user=company::find(User::find(Auth::id())->company_id)->tenantuser;

        $breadcrumbs = [
            ['link' => "/", 'name' => "Home"], ['link' => "management-department", 'name' => "Department"]
        ];

        return view('/content/management/department', ['pageConfigs' => $pageConfigs,'breadcrumbs' => $breadcrumbs,'data' => $data, 'formtxt' => $formtxt ,'pagetitle' =>'Departments','members'=>$all_user]);
    }

    public function edit(Request $request)
    {
        $where = array('id' => $request->id);
        $env  = Department::where($where)->first();
        $_find_department=DepartmentMember::where('department_id','=',$request->id)->where('company_id','=',Auth::user()->company_id)->where('type','=','hod')->pluck('user_id')->toArray();
        $all_uid=DepartmentMember::where('department_id','=',$request->id)->where('company_id','=',Auth::user()->company_id)->where('type','=','member')->pluck('user_id')->toArray();
        $data['id']=$env->id;
        $data['department_name']=$env->department_name;
        $data['company_id']=$env->company_id;
        $data['hod_id']=implode(',',$_find_department);
        $data['all_uid']=implode(',',$all_uid);


      //  dd($data);
        return response()->json($data);
    }

    public function company_policy(){
        $_company=company::find(User::find(Auth::user()->company_id))->first();

        if($_company->master_id===Auth::id()){

        }else{
            abort(403,"You don't have permission to access / on this server.");
        }
    }
    public function delete_department(Request $request)
    {
        $this->company_policy();
        $result=DepartmentMember::where('department_id','=',$request->id)->where('company_id','=',Auth::user()->company_id)->delete();
        $result=Department::where('id','=',$request->id)->where('company_id','=',Auth::user()->company_id)->where('is_default','=',0)->delete();

        return true;

    }
    public function store(Request $request)
    {

       if(!empty($request->modalHod) && !empty($request->modalMember)){
        //HOD not null , member not null

           $_display_hod='';
           $_hod_id='';
           foreach($request->modalHod as $value)
           {
               $u= User::find($value);
               $_display_hod.=$u->name.',';
               $_hod_id.=$value.',';
           }

           $_hod_id= substr($_hod_id, 0,-1);

           //merge hod&member and remove duplicate
           $_all_member=array_unique(array_merge($request->modalHod,$request->modalMember), SORT_REGULAR);
           $_all_memberid=implode(',',$request->modalMember);
           //array_unique(array_merge($array1,$array2), SORT_REGULAR);

           if(count($_all_member)==null){
               $d_all_member=0;
           }else{
               $d_all_member=count($_all_member);
           }
           $_display_hod= substr($_display_hod, 0,-1)??'';
           $_id=Department::updateOrCreate(
               [
                   'id' => $request->form_id,
               ],
               [
                   'department_name' => $request->basic_addon_name,
                   'company_id' => Auth::user()->company_id,
                   'slug' =>  Str::slug($request->basic_addon_name),
                   'total_member' =>$d_all_member ,
                   'total_hod' => count($request->modalHod),
                   'display_hod' => $_display_hod,
                   'hod_id' => $_hod_id,
                   'all_uid' =>$_all_memberid,

               ]
           );

           DepartmentMember::where('department_id', '=', $_id->id)->delete();

           $_department=Department::find($_id->id);
           $_department->member()->syncWithPivotValues($request->modalMember, ['type' => 'member','company_id'=>Auth::user()->company_id]);
           $_department->member()->attach  ($request->modalHod, ['type' => 'hod','company_id'=>Auth::user()->company_id]);
           return back()->with('success', 'Success！');
       }

        if(!empty($request->modalHod) && empty($request->modalMember)){
         //   dd('only hod');

            $_display_hod='';
            $_hod_id='';
            foreach($request->modalHod as $value)
            {
                $u= User::find($value);
                $_display_hod.=$u->name.',';
                $_hod_id.=$value.',';
            }
            $_display_hod= substr($_display_hod, 0,-1);
            $_hod_id= substr($_hod_id, 0,-1);

            //merge hod&member and remove duplicate
            $_all_member=array_unique(array_merge($request->modalHod), SORT_REGULAR);
            $_all_memberid='';
            //array_unique(array_merge($array1,$array2), SORT_REGULAR);

            if(count($_all_member)==null){
                $d_all_member=0;
            }else{
                $d_all_member=count($_all_member);
            }
            $_display_hod= substr($_display_hod, 0,-1)??'';

            $_id=Department::updateOrCreate(
                [
                    'id' => $request->form_id,
                ],
                [
                    'department_name' => $request->basic_addon_name,
                    'company_id' => Auth::user()->company_id,
                    'slug' =>  Str::slug($request->basic_addon_name),
                    'total_member' =>$d_all_member,
                    'total_hod' => count($request->modalHod),
                    'display_hod' => $_display_hod,
                    'hod_id' => $_hod_id,
                    'all_uid' =>$_all_memberid,

                ]
            );

            DepartmentMember::where('department_id', '=', $_id->id)->delete();

            $_department=Department::find($_id->id);
            $_department->member()->syncWithPivotValues($request->modalMember, ['type' => 'member','company_id'=>Auth::user()->company_id]);
            $_department->member()->attach  ($request->modalHod, ['type' => 'hod','company_id'=>Auth::user()->company_id]);
            return back()->with('success', 'Success！');

        }

        if(empty($request->modalHod) && !empty($request->modalMember)){
          //  dd('only member');

            $_display_hod='';
            $_hod_id='';

            //merge hod&member and remove duplicate
            $_all_member=array_unique(array_merge($request->modalMember), SORT_REGULAR);
            $_all_memberid=implode(',',$request->modalMember);
            //array_unique(array_merge($array1,$array2), SORT_REGULAR);


            if(count($_all_member)==null){
                $d_all_member=0;
            }else{
                $d_all_member=count($_all_member);
            }
            $_display_hod= substr($_display_hod, 0,-1)??'';
            $_id=Department::updateOrCreate(
                [
                    'id' => $request->form_id,
                ],
                [
                    'department_name' => $request->basic_addon_name,
                    'company_id' => Auth::user()->company_id,
                    'slug' =>  Str::slug($request->basic_addon_name),
                    'total_member' => $d_all_member,
                    'total_hod' => 0,
                    'display_hod' => $_display_hod,
                    'hod_id' => $_hod_id,
                    'all_uid' =>$_all_memberid,

                ]
            );

            DepartmentMember::where('department_id', '=', $_id->id)->delete();

            $_department=Department::find($_id->id);
            $_department->member()->syncWithPivotValues($request->modalMember, ['type' => 'member','company_id'=>Auth::user()->company_id]);
            $_department->member()->attach  ($request->modalHod, ['type' => 'hod','company_id'=>Auth::user()->company_id]);
            return back()->with('success', 'Success！');
        }
        if(empty($request->modalHod) && empty($request->modalMember)){






            $_id=Department::updateOrCreate(
                [
                    'id' => $request->form_id,
                ],
                [
                    'department_name' => $request->basic_addon_name,
                    'company_id' => Auth::user()->company_id,
                    'slug' =>  Str::slug($request->basic_addon_name),
                    'display_hod' => '',
                    'total_member' => 0,

                ]
            );
            return back()->with('success', 'Success！');
        }



    }

}
