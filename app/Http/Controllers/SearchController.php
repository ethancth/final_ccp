<?php

namespace App\Http\Controllers;

use App\Models\Company;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class SearchController extends Controller
{
    //

    public function getCompanyDomain(Request $request)
    {


        $_domain=Str::slug($request->value, '-');
        $_search=Company::where('slug','=',$_domain)->first();

        $data = [];
        if (!empty($_search)) {
            return response()->json(['message' => "Found",'id'=>$_search->slug]);
        }else
        {
            return response()->json(['message' => "already exits"], 422);
        }



    }
}
