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
        if($request->_id)
        {
            //update

            return redirect()->back()->with('success', 'Success！');
        }else{
            $input = [
                'name'                  => $request->tenant_name,
                'domain'                => str::slug($request->tenant_name,'-').Str::uuid(),
                'slug'                  => str::slug($request->tenant_name,'-').Str::uuid(),
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
