<?php

namespace App\Http\Controllers;

use App\Models\FirewallService;
use App\Models\VcNetwork;
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

    public function getnetworkbycluster(Request $request)
    {
        //dd($request->value);

        $result = VcNetwork::where('cluster','like','%'.$request->term['term'].'%')->where('status','=',1)->get(['id','name']);

        $data = [];

        if (!empty($result)) {

            foreach ($result as $record) {
                $nestedData['id'] = $record->id;
                $nestedData['text'] = $record->name;

                $data[] = $nestedData;
            }
        }

        return $data ;

    }

}
