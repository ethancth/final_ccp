<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Models\Tenant;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Yajra\DataTables\Facades\DataTables;
use function PHPUnit\Framework\assertDirectoryDoesNotExist;

class UserPageController extends Controller
{
    //
    //TODO user custom form
    public function demo(){
        return [

                'mainLayoutType' => 'vertical', // Options[String]: vertical(default), horizontal
                'theme' => 'semi-dark', // options[String]: 'light'(default), 'dark', 'bordered', 'semi-dark'
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
    public function first_login(){
        return [

                'mainLayoutType' => 'vertical', // Options[String]: vertical(default), horizontal
                'theme' => 'semi-dark', // options[String]: 'light'(default), 'dark', 'bordered', 'semi-dark'
                'sidebarCollapsed' => false, // options[Boolean]: true, false(default) (warning:this option only applies to the vertical theme.)
                'navbarColor' => '', // options[String]: bg-primary, bg-info, bg-warning, bg-success, bg-danger, bg-dark (default: '' for #fff)
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
    public function index(User $user, Request $request)
    {
        $pageConfigs = ['pageHeader' => false];

        //return view('/content/apps/user/app-user-list', ['pageConfigs' => $pageConfigs]);
        $totaluser=company::find(User::find(Auth::id())->company_id)->tenantuser->count();
        $all_department=company::find(User::find(Auth::id())->company_id)->department;
//        $data = company::find(User::find(Auth::id())->company_id)->user;
//        dd($data);
        if ($request->ajax())
        {
            $data = company::find(User::find(Auth::id())->company_id)->tenantuser;

            return Datatables::of($data)
//                ->addColumn('action', function($row){
//                    $btn = '<a href="javascript:void(0)" class="btn btn-primary btn-sm">View</a>';
//                    return $btn;
//                })
//                ->rawColumns(['action'])
                ->make(true);
        }

        return view('/content/user/home', ['pageConfigs' => $pageConfigs,'user' => $user,'totaluser'=> $totaluser,'departments'=>$all_department]);
    }

    public function store(Request $request)
    {

        //TODO add relationship in table;
        $_temp='0';
        if($request->user_role=='teamlead'||$request->user_role=='Teamlead'){
            $_temp='1';

        }

        $_checKisExist=User::where('email','=',$request->user_email)->first();

        if(!$_checKisExist){
           $_new_user= User::updateOrCreate(
                [
                    'id' => $request->user_id,
                ],
                [
                    'name' => $request->user_fullname,
                    'email' => $request->user_email,
//                'password' => Hash::make(Auth()->user()->company->default_password),
                    'password' => Hash::make($request->user_email),
                    'introduction' => $request->user_role,
                    'company_id' => User::find(Auth::id())->company_id,
                    'is_teamlead' => $_temp,
                ]);

        }else
        {
            $_new_user=$_checKisExist;
        }

        $_check_user_tenant_amount=$_new_user->tenant->count();

        $_check_is_user_is_in_tenant_result= $_new_user->tenant->contains('id', Auth::user()->company_id);
        if($_check_user_tenant_amount<3 && $_check_is_user_is_in_tenant_result==false){
            $updatetenant=Tenant::create([
                'user_id' =>  $_new_user->id,
                'action' =>  'User '.Auth()->id() .' Create this user',
                'company_id' => Auth::user()->company_id,
            ]);
            return redirect()->route('user')->with('success', 'Success！');
        }
        else
        {
            return redirect()->route('user')->with('warning', 'This User has more than 3 tenant');
        }



    }

    public function update_credential(Request $request)
    {

        User::updateOrCreate(
            [
                'id' => Auth::User()->id,
            ],
            [
                'password' => Hash::make($request->newPassword),
            ]);
        return redirect()->route('user')->with('success', 'Success！');
    }

}
