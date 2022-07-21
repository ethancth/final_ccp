<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Yajra\DataTables\Facades\DataTables;
use function PHPUnit\Framework\assertDirectoryDoesNotExist;

class UserPageController extends Controller
{
    //

    public function index(User $user, Request $request)
    {
        $pageConfigs = ['pageHeader' => false];
        //dd(User::find(Auth::id())->company_id);

        //return view('/content/apps/user/app-user-list', ['pageConfigs' => $pageConfigs]);
        $totaluser=User::find(Auth::id())->company->user->count();
//        $data = company::find(User::find(Auth::id())->company_id)->user;
//        dd($data);
        if ($request->ajax())
        {
            $data = company::find(User::find(Auth::id())->company_id)->user;

            return Datatables::of($data)
//                ->addColumn('action', function($row){
//                    $btn = '<a href="javascript:void(0)" class="btn btn-primary btn-sm">View</a>';
//                    return $btn;
//                })
//                ->rawColumns(['action'])
                ->make(true);
        }

        return view('/content/user/home', ['pageConfigs' => $pageConfigs,'user' => $user,'totaluser'=> $totaluser]);
    }

    public function store(Request $request)
    {
       // dd($request);
        //TODO add relationship in table;
        $_temp='0';
        if($request->user_role=='teamlead'||$request->user_role=='Teamlead'){
            $_temp='1';

        }

        User::updateOrCreate(
            [
                'id' => $request->user_id,
            ],
            [
                'name' => $request->user_fullname,
                'email' => $request->user_email,
                'password' => Hash::make('password'),
                'introduction' => $request->user_role,
                'company_id' => User::find(Auth::id())->company_id,
                'is_teamlead' => $_temp,
            ]);
        return redirect()->route('user')->with('success', 'Success！');
    }

}
