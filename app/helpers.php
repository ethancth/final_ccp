<?php


function remove_spacing($string): string|null
{
    return $string = preg_replace('/\s+/', '', $string);
}

function demo(){
    return "demo txt";
}

function getSAName($request)
{
   // $request = '1,2,3';
    $myArray = explode(',', $request);
   // echo $request;
    $sas = \App\Models\ServiceApplication::select("display_name")
        ->whereIn('id', $myArray)
        ->get();
    $_new_name='';
    foreach($sas as $sa){
        $_new_name.=$sa->display_name." ,";
    }
    return $resuleName=substr($_new_name, 0, -2);


}
