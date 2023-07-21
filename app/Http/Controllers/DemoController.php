<?php

namespace App\Http\Controllers;

use App\Models\FirewallService;
use Illuminate\Http\Request;

class DemoController extends Controller
{
    //

    public function demo(Request $request)
    {
        dd($request);
    }

    public function getservice(Request $request)
    {
        //dd($request->value);

        return FirewallService::where('type','=',$request->value)->firstOrFail();

    }

}
