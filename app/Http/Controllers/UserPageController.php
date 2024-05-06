<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Models\Department;
use App\Models\DepartmentMember;
use App\Models\Position;
use App\Models\Roles;
use App\Models\Tenant;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;
use Yajra\DataTables\Facades\DataTables;
use function PHPUnit\Framework\assertDirectoryDoesNotExist;

class UserPageController extends Controller
{
    //


    //TODO user custom form
    public function demo()
    {

        if(Auth::check()){
            $current_theme=Auth::User()->theme;
        }else{
            $current_theme='light';
        }

            return [

            'mainLayoutType' => 'vertical', // Options[String]: vertical(default), horizontal
            'theme' => $current_theme, // options[String]: 'light'(default), 'dark', 'bordered', 'semi-dark'
            'sidebarCollapsed' => false, // options[Boolean]: true, false(default) (warning:this option only applies to the vertical theme.)
            'navbarColor' => '', // options[String]: bg-primary, bg-info, bg-warning, bg-success, bg-danger, bg-dark (default: '' for #fff)
            'horizontalMenuType' => 'floating', // options[String]: floating(default) / static /sticky (Warning:this option only applies to the Horizontal theme.)
            'verticalMenuNavbarType' => 'floating', // options[String]: floating(default) / static / sticky / hidden (Warning:this option only applies to the vertical theme)
            'footerType' => 'static', // options[String]: static(default) / sticky / hidden
            'layoutWidth' => 'full', // options[String]: full / boxed(default),
            'showMenu' => true, // options[Boolean]: true(default), false //show / hide main menu (Warning: if set to false it will hide the main menu)
            'bodyClass' => '', // add custom class
            'pageHeader' => true, // options[Boolean]: true(default), false (Page Header for Breadcrumbs)
            'contentLayout' => 'default', // options[String]: default, content-left-sidebar, content-right-sidebar, content-detached-left-sidebar, content-detached-right-sidebar (warning:use this option if your whole project with sidenav Otherwise override this option as page level )
            'defaultLanguage' => 'en',    //en(default)/de/pt/fr here are four optional language provided in theme
            'blankPage' => false, // options[Boolean]: true, false(default) (warning:only make true if your whole project without navabr and sidebar otherwise override option page wise)
            'direction' => env('MIX_CONTENT_DIRECTION', 'ltr'), // Options[String]: ltr(default), rtl
        ];
    }

    public function first_login()
    {
        return [

            'mainLayoutType' => 'vertical', // Options[String]: vertical(default), horizontal
            'theme' => 'semi-dark', // options[String]: 'light'(default), 'dark', 'bordered', 'semi-dark'
            'sidebarCollapsed' => false, // options[Boolean]: true, false(default) (warning:this option only applies to the vertical theme.)
            'navbarColor' => 'bg-danger', // options[String]: bg-primary, bg-info, bg-warning, bg-success, bg-danger, bg-dark (default: '' for #fff)
            'horizontalMenuType' => 'floating', // options[String]: floating(default) / static /sticky (Warning:this option only applies to the Horizontal theme.)
            'verticalMenuNavbarType' => 'floating', // options[String]: floating(default) / static / sticky / hidden (Warning:this option only applies to the vertical theme)
            'footerType' => 'static', // options[String]: static(default) / sticky / hidden
            'layoutWidth' => 'full', // options[String]: full / boxed(default),
            'showMenu' => false, // options[Boolean]: true(default), false //show / hide main menu (Warning: if set to false it will hide the main menu)
            'bodyClass' => '', // add custom class
            'pageHeader' => true, // options[Boolean]: true(default), false (Page Header for Breadcrumbs)
            'contentLayout' => 'default', // options[String]: default, content-left-sidebar, content-right-sidebar, content-detached-left-sidebar, content-detached-right-sidebar (warning:use this option if your whole project with sidenav Otherwise override this option as page level )
            'defaultLanguage' => 'en',    //en(default)/de/pt/fr here are four optional language provided in theme
            'blankPage' => false, // options[Boolean]: true, false(default) (warning:only make true if your whole project without navabr and sidebar otherwise override option page wise)
            'direction' => env('MIX_CONTENT_DIRECTION', 'ltr'), // Options[String]: ltr(default), rtl
        ];
    }

    public function edit(Request $request)
    {
        $where = array('id' => $request->id);
        $result = User::where($where)->first();
        $_find_department = DepartmentMember::where('user_id', '=', $request->id)->where('company_id', '=', Auth::user()->company_id)->where('type', '=', 'hod')->pluck('department_id')->toArray();
        $all_uid = DepartmentMember::where('user_id', '=', $request->id)->where('company_id', '=', Auth::user()->company_id)->where('type', '=', 'member')->pluck('department_id')->toArray();
        $data['id'] = $request->id;
        $data['name'] = $result->name;
        $data['email'] = $result->email;
        $data['department_hod'] = implode(',', $_find_department);
        $data['department_member'] = implode(',', $all_uid);


        return response()->json($data);
    }

    public function company_policy()
    {
        $_company = company::where('id', '=', Auth::user()->company_id)->first();

        if ($_company->master_id === Auth::id()) {

        } else {
            abort(403, "You don't have permission to access / on this server.");
        }
    }

    public function index(User $user, Request $request)
    {
//        $this->company_policy();
        $pageConfigs = ['pageHeader' => false];


        //return view('/content/apps/user/app-user-list', ['pageConfigs' => $pageConfigs]);
        $totaluser = company::find(User::find(Auth::id())->company_id)->tenantuser->count();
        $master_id = company::find(User::find(Auth::id())->company_id)->master_id;
        $totalinactiveuser = company::find(User::find(Auth::id())->company_id)->tenantuser->where('email_verified_at', '!=', NULL)->count();
        $totalactiveuser = company::find(User::find(Auth::id())->company_id)->tenantuser->where('email_verified_at', '=', NULL)->count();

        $all_department = company::find(User::find(Auth::id())->company_id)->department;

        $data = company::find(User::find(Auth::id())->company_id)->user;
//        $data = company::find(User::find(Auth::id())->company_id)->user;
//        dd($data);
        if ($request->ajax()) {
            $data = company::find(User::find(Auth::id())->company_id)->user;

            return Datatables::of($data)
                ->addColumn('role_name', function(User $user) {
                    return  $user->role_name;
                })
//                ->addColumn('action', function($row){
//                    $btn = '<a href="javascript:void(0)" class="btn btn-primary btn-sm">View</a>';
//                    return $btn;
//                })
//                ->rawColumns(['action'])
                ->make(true);
        }


        $roles = Role::all();
        $breadcrumbs = [
            ['link' => "/", 'name' => "Home"], ['link' => "user-management", 'name' => "Users"]
        ];

        return view('/content/user/home', ['roles' => $roles, 'pageConfigs' => $pageConfigs, 'pagetitle' => 'Users', 'breadcrumbs' => $breadcrumbs, 'mid' => $master_id, 'user' => $user, 'totaluser' => $totaluser, 'departments' => $all_department, 'active_user' => $totalactiveuser, 'in_active_user' => $totalinactiveuser]);
    }

    public function store(Request $request)
    {

        $this->company_policy();



        $_checKisExist = User::where('email', '=', $request->user_email)->first();

        $_new_user = User::updateOrCreate(
            [
                'id' => $request->user_id,
            ],
            [
                'name' => $request->user_fullname,
                'email' => $request->user_email,
//                'password' => Hash::make(Auth()->user()->company->default_password),
                'password' => Hash::make($request->user_email),
                'introduction' => '',
                'company_id' => User::find(Auth::id())->company_id,
            ]);

        $_position=Roles::find($request->role);
        $_new_user->syncRoles($_position->name);

        if (!$_checKisExist) {

         //   $_new_user->sendEmailVerificationNotification();

        }
        $_check_user_tenant_amount = $_new_user->tenant->count();

        $_check_is_user_is_in_tenant_result = $_new_user->tenant->contains('id', Auth::user()->company_id);



//        if ($_check_is_user_is_in_tenant_result == true) {
//            $this->join_department($request, $_new_user);
//
//        }

            $_check_user_tenant_amount = $_new_user->tenant->count();

            $_check_is_user_is_in_tenant_result = $_new_user->tenant->contains('id', Auth::user()->company_id);


//            if ($_check_is_user_is_in_tenant_result == true) {
//
//                $this->join_department($request, $_new_user);
//                return redirect()->route('user')->with('success', 'Success！');
//            }else if ($_check_user_tenant_amount < 3 && $_check_is_user_is_in_tenant_result == false) {
//                //
                $updatetenant = Tenant::create([
                    'user_id' => $_new_user->id,
                    'action' => 'User id[' . Auth()->id() . '] - ' . Auth()->user()->name . ' Create this user',
                    'company_id' => Auth::user()->company_id,
                ]);

                $this->join_department($request, $_new_user);


                return redirect()->route('user')->with('success', 'Success！');
//            } else {
//                return redirect()->route('user')->with('warning', 'This User has more than 3 tenant');
//            }





    }


    public function join_department($request,User $user){

        if(!empty($request->modalHod)) {



            $_hod_id = '';
            foreach ($request->modalHod as $value) {

                $user_array=array($user->id);

                $_find_department=DepartmentMember::where('department_id','=',$value)->where('company_id','=',Auth::user()->company_id)->where('type','=','hod')->pluck('user_id')->toArray();
                $_hod_member=array_unique(array_merge($_find_department,$user_array), SORT_REGULAR);
                $_find_all_department=DepartmentMember::where('department_id','=',$value)->where('company_id','=',Auth::user()->company_id)->pluck('user_id')->toArray();
                $_all_member=array_unique(array_merge($_find_all_department,$user_array), SORT_REGULAR);
                $all_hod_member=implode(',',$_hod_member);


                $_display_hod = '';

                foreach($_hod_member as $hodvalue)
                {
                    $u= User::find($hodvalue);
                    $_display_hod.=$u->name.',';
                    $_hod_id.=$hodvalue.',';
                }
                $_display_hod= substr($_display_hod, 0,-1);


                $_id=Department::updateOrCreate(
                    [
                        'id' => $value,
                    ],
                    [
                        'total_member' => count($_all_member),
                        'total_hod' => count($_hod_member),
                        'display_hod' => $_display_hod,
                        'hod_id' => $all_hod_member,

                    ]
                );

                DepartmentMember::where('user_id', '=',$user->id)->where('company_id','=',Auth::user()->company_id)->where('type','=','hod')->delete();

                $_department=Department::find($value);
               // $_department->member()->syncWithPivotValues($request->modalMember, ['type' => 'member','company_id'=>Auth::user()->company_id]);
                $_department->member()->attach  ($_hod_member, ['type' => 'hod','company_id'=>Auth::user()->company_id]);

            }
        }


        if(!empty($request->modalMember)) {


            $_display_hod = '';
            $_hod_id = '';
            foreach ($request->modalMember as $value) {

                $user_array=array($user->id);

                $_find_department=DepartmentMember::where('department_id','=',$value)->where('company_id','=',Auth::user()->company_id)->where('type','=','member')->pluck('user_id')->toArray();
                $_department_member=array_unique(array_merge($_find_department,$user_array), SORT_REGULAR);


                $_find_all_department=DepartmentMember::where('department_id','=',$value)->where('company_id','=',Auth::user()->company_id)->pluck('user_id')->toArray();
                $_all_member=array_unique(array_merge($_find_all_department,$user_array), SORT_REGULAR);



                $_department_member=implode(',',$_department_member);
                $_id=Department::updateOrCreate(
                    [
                        'id' => $value,
                    ],
                    [
                        'total_member' => count($_all_member),
                         'all_uid' =>$_department_member,

                    ]
                );

                DepartmentMember::where('department_id', '=',$value)->where('company_id','=',Auth::user()->company_id)->where('type','=','member')->delete();

                $_department=Department::find($value);
                 $_department->member()->attach($_department_member, ['type' => 'member','company_id'=>Auth::user()->company_id]);
                //$_department->member()->attach  ($_hod_member, ['type' => 'hod','company_id'=>Auth::user()->company_id]);

            }
        }

}

    public function remove_member(Request $request)
    {
        $this->company_policy();
        $result=DepartmentMember::where('user_id','=',$request->id)->where('company_id','=',$this->get_current_company())->delete();
        $result=Tenant::where('user_id','=',$request->id)->where('company_id','=',$this->get_current_company())->delete();

        return true;
    }
    public function get_current_company()
    {
        return Auth::user()->company_id;
    }
    public function update_credential(Request $request)
    {

       // dd($request);
       if($request->confirmPassword!=null){
           User::updateOrCreate(
               [
                   'id' => Auth::User()->id,
               ],
               [
                   'name'=>$request->username,
                   'password' => Hash::make($request->newPassword),
               ]);
       }else{
           User::updateOrCreate(
               [
                   'id' => Auth::User()->id,
               ],
               [
                   'name'=>$request->username,
               ]);
       }

        return redirect()->route('tenants.profile')->with('success', 'Success！');
    }

}
