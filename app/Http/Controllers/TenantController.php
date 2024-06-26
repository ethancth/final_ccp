<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Models\TbWarning;
use App\Models\Tenant;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class TenantController extends Controller
{
    //

    public function CreateTenantProfile(Request $request)
    {

        $_set_max_tenant=3;
        $result=Company::where('name','=',$request->tenant_name)->first();
        $_check_user_max_tenant=Company::where('master_id','=',Auth::id())->count();
        if($_check_user_max_tenant>$_set_max_tenant){
            return response()->json(['message' => "Maximum Tenants Profile Create."], 422);
        }


        if(!$result)
        {
            $input = [
                'name'                  => $request->tenant_name,
                'domain'                => str::slug($request->tenant_name,'-').Str::uuid(),
                'slug'                  => Str::uuid(),
                'default_password'      => NULL,
                'is_new_company'        => '0',
                'master_id'        => Auth::id(),

            ];

            $new=Company::Create($input);

            $new_tenant_input=  Tenant::create([
                'user_id' =>  Auth()->id(),
                'action' =>  'User '.Auth()->id() .'Create this',
                'company_id' => $new->id
            ]);

            return redirect()->back()->with('success', 'Success！');
        }else{
            return response()->json(['message' => "This tenant name Unavailable, Please use another name"], 422);

        }


    }
    public function SwitchTenant(Request $request)
    {

       $result= Auth::user()->tenant->contains('id', $request->tenant_id);

      if($result)
      {

          $u=User::find(Auth()->id());
          $u->company_id=$request->tenant_id;
          $u->save();

          return redirect()->back()->with('success', 'Switch tenant success!');
      }else{



          $input = [
              'user_id'    => Auth()->id(),
              'record'    => json_encode($request->all()),
              'url'    => $request->url(),
              'action'    => 'on Tenant Controller',

          ];

          TbWarning::Create($input);



          return redirect()->back()->with('warning', 'No Authorise！');
      }
    }

    public function TenantProfile(Request $request)
    {
        $breadcrumbs = [

        ];
        return view('/content/tenant/profile', [
            'breadcrumbs' => $breadcrumbs
        ]);
    }

}
