<?php

namespace App\Http\Controllers;

use App\Models\DatastoreCostProfile;
use Illuminate\Http\Request;
use App\Models\Cluster;
use App\Models\Vmtable;
use Auth;

class DatastoreCostProfileController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth', ['except' => ['']]);
    }
    public function index(DatastoreCostProfile $datastore_cost_profile)
    {
        $costprofiles=DatastoreCostProfile::All();
        $breadcrumbs = [
            ['link'=>"..\dashboard-ecommerce",'name'=>"Home"], ['name'=>"Datastore Cost Profile"]
        ];

        return view('pages.datastore.index',compact('costprofiles'), [
            'breadcrumbs' => $breadcrumbs
        ]);
    }

    public function create(DatastoreCostProfile $datastore_cost_profile)
    {
        $costprofile=$datastore_cost_profile;

        $breadcrumbs = [
            ['link'=>"..\dashboard-ecommerce",'name'=>"Home"], ['name'=>"Cost Profile"],['name'=>"Create Profile"]
        ];
        return view('pages.datastore.create_and_edit',compact('costprofile'), [
            'breadcrumbs' => $breadcrumbs
        ]);
    }

    public function store(Request $request, DatastoreCostProfile $datastore_cost_profile)
    {
        $datastore_cost_profile->fill($request->all());
        $datastore_cost_profile->created_by = Auth::id();
        if($request->vstorage_unit=='GB'){
            $datastore_cost_profile->h_vstorage_price=$request->vstorage_price/$request->vstorage;
        }else{
            $datastore_cost_profile->h_vstorage_price=$request->vstorage_price/($request->vstorage*1000);
        }



        $datastore_cost_profile->save();
        return redirect()->to('datastore-cost-profile')->with('success', '成功创建话题！');
    }

    public function edit(DatastoreCostProfile $datastore_cost_profile)
    {

        $costprofile=$datastore_cost_profile;
        $breadcrumbs = [
            ['link'=>"..\dashboard-ecommerce",'name'=>"Home"], ['name'=>"Cost Profile"],['name'=>"Edit Datastore Cost Profile"]
        ];
        return view('pages.datastore.create_and_edit',compact('costprofile'), [
            'breadcrumbs' => $breadcrumbs
        ]);
    }



    public function update(Request $request, DatastoreCostProfile $datastore_cost_profile)
    {


        if($request->vstorage_unit=='GB'){
            $datastore_cost_profile->h_vstorage_price=$request->vstorage_price/$request->vstorage;
        }else{
            $datastore_cost_profile->h_vstorage_price=$request->vstorage_price/($request->vstorage*1000);
        }

        $datastore_cost_profile->update($request->all());

        return redirect()->to('datastore-cost-profile')->with('success', '成功创建话题！');
    }
}
