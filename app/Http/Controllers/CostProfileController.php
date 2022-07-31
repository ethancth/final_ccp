<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CostProfile;
use App\Models\Cluster;
use App\Models\Vmtable;
use Auth;

class CostProfileController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth', ['except' => ['']]);
    }

    public function index(CostProfile $costprofile)
    {
        $costprofiles=CostProfile::All();
        $breadcrumbs = [
            ['link'=>"..\dashboard-ecommerce",'name'=>"Home"], ['name'=>"Cost Profile"]
        ];

        return view('pages-old.costprofile.index',compact('costprofiles'), [
            'breadcrumbs' => $breadcrumbs
        ]);
    }

    public function create(CostProfile $costprofile)
    {

        $breadcrumbs = [
            ['link'=>"..\dashboard-ecommerce",'name'=>"Home"], ['name'=>"Cost Profile"],['name'=>"Create Profile"]
        ];
        return view('pages.costprofile.create_and_edit',compact('costprofile'), [
            'breadcrumbs' => $breadcrumbs
        ]);
    }

    public function store(Request $request, CostProfile $costprofile)
    {
        $costprofile->fill($request->all());
        $costprofile->created_by = Auth::id();
        $costprofile->h_vcpu_price=$request->vcpu_price/$request->vcpu;
        $costprofile->h_vmen_price=$request->vmen_price/$request->vmen;
        $costprofile->save();
        return redirect()->to('cost-profile')->with('success', '成功创建话题！');
    }

    public function edit(CostProfile $cost_profile)
    {

        $costprofile=$cost_profile;
        $breadcrumbs = [
            ['link'=>"..\dashboard-ecommerce",'name'=>"Home"], ['name'=>"Cost Profile"],['name'=>"Edit Cost Profile"]
        ];
        return view('pages.costprofile.create_and_edit',compact('costprofile'), [
            'breadcrumbs' => $breadcrumbs
        ]);
    }

    public function update(Request $request, CostProfile $cost_profile)
    {


        $cost_profile->h_vcpu_price=$request->vcpu_price/$request->vcpu;
        $cost_profile->h_vmen_price=$request->vmen_price/$request->vmen;


        $cost_profile->update($request->all());

        return redirect()->to('cost-profile')->with('success', '成功创建话题！');
    }
}
