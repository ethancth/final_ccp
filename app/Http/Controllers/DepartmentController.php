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

        return view('/content/management/department', ['pageConfigs' => $pageConfigs,'breadcrumbs' => $breadcrumbs,'data' => $data, 'formtxt' => $formtxt ,'pagetitle' =>'Management','members'=>$all_user]);
    }

    public function edit(Request $request)
    {
        $where = array('id' => $request->id);
        $env  = Department::where($where)->first();

        return response()->json($env);
    }

    public function store(Request $request)
    {



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
        $_all_member=array_unique(array_merge($request->modalHod,$request->modalMember), SORT_REGULAR);
        $_all_memberid=implode(',',$request->modalMember);
        //array_unique(array_merge($array1,$array2), SORT_REGULAR);
        $_id=Department::updateOrCreate(
            [
                'id' => $request->form_id,
            ],
            [
                'department_name' => $request->basic_addon_name,
                'company_id' => Auth::user()->company_id,
                'slug' =>  Str::slug($request->basic_addon_name),
                'total_member' => count($_all_member),
                'total_hod' => count($request->modalHod),
                'display_hod' => $_display_hod,
                'hod_id' => $_hod_id,
                'all_uid' =>$_all_memberid,

            ]
        );

        DepartmentMember::where('department_id', '=', $_id->id)->delete();

        $_department=Department::find($_id->id);
        $_department->member()->syncWithPivotValues($request->modalMember, ['type' => 'member']);
        $_department->member()->attach  ($request->modalHod, ['type' => 'hod']);
        return back()->with('success', 'Success！');
    }

}
