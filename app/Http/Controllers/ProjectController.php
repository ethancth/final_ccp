<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Project;

class ProjectController extends Controller
{
    //

    public function list()
    {
         $pageConfigs = ['pageHeader' => false,];

        return view('/content/apps/rolesPermission/app-access-permission', ['pageConfigs' => $pageConfigs]);
    }
}
