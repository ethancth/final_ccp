<?php

namespace App\Http\Controllers;

use App\Models\TbWarning;
use App\Models\Tenant;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TenantController extends Controller
{
    //

    public function SwitchTenant(Request $request)
    {

       $result= Auth::user()->tenant->contains('id', $request->tenant_id);

      if($result)
      {

          $u=User::find(Auth()->id());
          $u->company_id=$request->tenant_id;
          $u->save();

          return redirect()->back()->with('success', 'Success！');
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
}
