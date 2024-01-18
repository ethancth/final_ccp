<?php

use App\Http\Controllers\CompanyFormController;
use App\Http\Controllers\CostProfileController;
use App\Http\Controllers\DemoController;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\FirewallServiceControler;
use App\Http\Controllers\InfraController;
use App\Http\Controllers\ProjectSecurityGroupController;
use App\Http\Controllers\ServerController;
use App\Http\Controllers\TenantController;
use App\Http\Controllers\UserPageController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LanguageController;
use App\Http\Controllers\ProjectController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Main Page Route


/* Route Dashboards */

Auth::routes(['verify' => true]);
Route::group(['middleware' => ['auth', 'verified']],
    function () {
// Route Dashboards

        Route::get('/', [ProjectController::class, 'index'])->name('dashboard');





        //User Management
       // Route::resource('users', 'UserPagesController', ['only' => ['show', 'update', 'edit']]);
       // Route::get('/user-list', 'UserPagesController@user_list')->name('user.list');

        //department
//        Route::resource('department', 'DepartmentController', ['only' => ['show', 'update', 'edit']]);
//        Route::get('/department', 'DepartmentController@list')->name('department.list');
//
//        //operating-expense
//        Route::resource('operating-expense', 'OperatingExpenseController', ['only' => ['create', 'update', 'edit', 'store']]);
//        Route::get('/operating-expense', 'OperatingExpenseController@list')->name('operating-expense');
//
//        //Cost Profile
        Route::resource('cost-profile', CostProfileController::class, ['only' => ['create', 'update', 'edit', 'store']]);
        Route::get('/cost-profile', [CostProfileController::class,'index'])->name('cost-profile');
//
        //Environment
        Route::get('/management-environment', [CompanyFormController::class, 'envform'])->name('management_env');
        Route::post('/management-environment', [CompanyFormController::class, 'env_request'])->name('management.env.store');
        Route::post('/management-environment-edit', [CompanyFormController::class, 'env_edit'])->name('management.env.edit');
        Route::post('/management-environment-delete', [CompanyFormController::class, 'env_delete'])->name('management.env.delete');

        //Department
        Route::get('/management-department', [DepartmentController::class, 'show'])->name('department.show');
        Route::post('/management-department',[DepartmentController::class,'store'])->name('department.store');
        Route::post('/management-department-edit', [DepartmentController::class, 'edit'])->name('department.edit');
        Route::post('/management-department-delete', [DepartmentController::class, 'delete_department'])->name('department.delete');

        //Tier
        Route::get('/management-tier', [CompanyFormController::class, 'tierform'])->name('management_tier');
        Route::post('/management-tier', [CompanyFormController::class, 'tier_request'])->name('management.tier.store');
        Route::post('/management-tier-edit', [CompanyFormController::class, 'tier_edit'])->name('management.tier.edit');
        Route::post('/management-tier-delete', [CompanyFormController::class, 'tier_delete'])->name('management.tier.delete');

        //Operating System
        Route::get('/management-os', [CompanyFormController::class, 'osform'])->name('management_os');
        Route::post('/management-os', [CompanyFormController::class, 'os_request'])->name('management.os.store');
        Route::post('/management-os-edit', [CompanyFormController::class, 'os_edit'])->name('management.os.edit');
        Route::post('/management-os-delete', [CompanyFormController::class, 'os_delete'])->name('management.os.delete');

        //Service Application
        Route::get('/management-service-application', [CompanyFormController::class, 'saform'])->name('management_sa');
        Route::post('/management-sa', [CompanyFormController::class, 'sa_request'])->name('management.sa.store');
        Route::post('/management-sa-edit', [CompanyFormController::class, 'sa_edit'])->name('management.sa.edit');
        Route::post('/management-sa-delete', [CompanyFormController::class, 'sa_delete'])->name('management.sa.delete');

        //Firewall Service
        Route::get('/management-firewall-services', [FirewallServiceControler::class, 'index'])->name('management_firewall_service');
        Route::post('/management-firewall-services-store', [FirewallServiceControler::class, 'store'])->name('management_firewall_service.store');
        Route::post('/management-firewall-services-edit', [FirewallServiceControler::class, 'edit'])->name('management_firewall_service.edit');

        //Cost Form
        Route::get('/management-cost', [CompanyFormController::class, 'costform'])->name('management_cost');
        Route::post('/management-costform', [CompanyFormController::class, 'costform_store'])->name('management.costform.store');
        Route::post('/management-company', [CompanyFormController::class, 'companyform_store'])->name('management.company.store');

        //policy Form
        Route::get('/management-policy-form', [CompanyFormController::class, 'policyform'])->name('management_policyform');
        Route::post('/management-policy-form', [CompanyFormController::class, 'policyform_store'])->name('management_policyform.store');

        //filter Policy
        Route::get('/filter-policy-form', [CompanyFormController::class, 'getMandatoryService'])->name('filter_policy');
        Route::get('/get-service-name', [CompanyFormController::class, 'getServiceName'])->name('service_name');

        //server Cost
        Route::get('/get-cost', [CompanyFormController::class, 'getCost'])->name('server_cost');

//        //Department Cost Profile
//        Route::resource('department-cost-profile', 'ClusterCostProfileController', ['only' => ['update', 'edit', 'store']]);
//        Route::get('/department-cost-profile', 'ClusterCostProfileController@index')->name('department-cost-profile');
//
//
        Route::get('/demos/{id}', function (string $id) {

            $records = [
                [
                    "state"  => "IN",
                    "city"   => "Indianapolis",
                    "object" => "School bus"
                ],
                [
                    "state"  => "IN",
                    "city"   => "Indianapolis",
                    "object" => "Manhole"
                ],
                [
                    "state"  => "IN",
                    "city"   => "Plainfield",
                    "object" => "Basketball"
                ],
                [
                    "state"  => "CA",
                    "city"   => "San Diego",
                    "object" => "Light bulb"
                ],
                [
                    "state"  => "CA",
                    "city"   => "Mountain View",
                    "object" => "Space pen"
                ]
            ];
            foreach ($records as $resule)
            {
                echo $resule['city'].'<br/>';
            }
            //return 'User '.$id;
        });

//
//        //TODO datastore
//        Route::get('/datastore', 'DatastoreController@table')->name('datastore');
//        Route::resource('datastore', 'DatastoreController', ['only' => ['update', 'edit', 'store']]);
//
//        Route::resource('datastore-cost-profile', 'DatastoreCostProfileController', ['only' => ['create', 'update', 'edit', 'store']]);
//        Route::get('/datastore-cost-profile', 'DatastoreCostProfileController@index')->name('datastore-cost-profile');
//

        //Search

        Route::get('getCompanyDomain', [\App\Http\Controllers\SearchController::class, 'getCompanyDomain'])->name('getCompanyDomain');
//        //Project

        Route::get('/project', [ProjectController::class, 'index'])->name('project');
        Route::post('/project', [ProjectController::class, 'store'])->name('project.store');
        Route::delete('/project/{id}', [ProjectController::class, 'projectdestroy'])->name('project.destroy');
     //   Route::post('/project', [ProjectController::class, 'storeprojectsg'])->name('project.securitygroup.store');
        Route::post('/submitproject', [ProjectController::class, 'submitproject'])->name('project.submit');
        Route::post('/approveproject', [ProjectController::class, 'approveproject'])->name('project.approve');
        Route::post('/rejectproject', [ProjectController::class, 'rejectproject'])->name('project.reject');

        Route::post('/projectsg/security-group/store', [ProjectController::class, 'storeprojectsg'])->name('project.securitygroup.store');
        Route::get('/project/{project}/{slug?}', [ProjectController::class, 'show'])->name('project.show');
        Route::post('/projectserver', [ProjectController::class, 'storeserver'])->name('project.storeserver');
        Route::post('/editprojectserver', [ProjectController::class, 'edit'])->name('project.editserver');
        Route::post('/deleteprojectserver', [ProjectController::class, 'destroy'])->name('project.delete');



        Route::get('asset/project/{project}/{slug?}', [ProjectController::class, 'assetshow'])->name('project.asset.show');

        Route::post('read_content', [DemoController::class, 'demo'])->name('demo');
        Route::get('read_available_service', [DemoController::class, 'getservice'])->name('getservice');


        Route::post('get_security_group_member', [ProjectSecurityGroupController::class, 'getservice'])->name('get.psg.member');
        Route::post('update_security_group_member', [ProjectSecurityGroupController::class, 'getpsg_member_store'])->name('psg.member.store');



//        //Route::resource('project', 'ProjectController', ['only' => ['store']]);
//        //Route::get('/project', 'ProjectController@list')->name('project');
//        //Route::get('/project/{project}/info', 'ProjectController@info')->name('project.info');
//       // Route::resource('projectvm', 'ProjectVmController', ['only' => ['store']]);
//
//        //Company & user
        Route::get('/user-management', [UserPageController::class, 'index'])->name('user');
        Route::post('/user-management', [UserPageController::class, 'store'])->name('user.store');
        Route::post('/user-management-edit', [UserPageController::class, 'edit'])->name('user.edit');
        Route::post('/user-management-remove-user', [UserPageController::class, 'remove_member'])->name('user.remove');

        //Server Object
        Route::get('server',[ServerController::class,'index'])->name('server');

        //ServerFirewall
        Route::get('/server/{server}/firewall', [ServerController::class, 'firewall'])->name('server.firewall.old');


        //ServerFirewall
          Route::post('/server/{server}/firewall', [ServerController::class, 'create_server_firewall'])->name('server.firewall');
//        Route::get('/server/{server}/firewall', [ServerController::class, 'firewall'])->name('server.firewall');
        Route::get('/server/{server}/information', [ServerController::class, 'information'])->name('server.information');

        Route::post('/server/firewall/request/store', [ServerController::class, 'firewall_request'])->name('server.firewall.store');
        Route::get('/server/firewall/request/edit', [ServerController::class, 'firewall_request_edit'])->name('server.firewall.edit');
        Route::get('/server/firewall/request/get', [ServerController::class, 'firewall_request_get'])->name('server.get.firewall.port');





        //ProjectServer subscribe firewall

        Route::post('server/firewall/{firewallService}/subscribe', [FirewallServiceControler::class, 'favor'])->name('firewall.subscribe');

        //ProjectSecurityGroup
        Route::get('/SG/{project}/', [ProjectController::class, 'sg'])->name('project.sg');
        Route::post('/SG/store', [ProjectController::class, 'sg_store'])->name('project.sg.store');
        Route::post('/SG/edit', [ProjectController::class, 'get_sg_env_firewall'])->name('project.sg.env.firewall.store');


        Route::post('/asset-project/security-group/store', [ProjectController::class, 'new_sg_store'])->name('project.new.sg.store');





        //Asset ProjectAssetController
        Route::get('/asset-project', [ProjectController::class, 'asset'])->name('asset.project');

        Route::post('/api/asset/project/firewall/new', [ProjectController::class, 'create_project_firewall'])->name('project.firewall.new');
        Route::get('/api/asset/project/firewall/edit', [ProjectController::class, 'get_project_firewall'])->name('project.firewall.edit');
        Route::get('/api/asset/project/firewall/get', [ProjectController::class, 'get_firewall_ports'])->name('project.get.firewall.port');




        //Infrastructure
        Route::get('management-infrastructure-connector', [InfraController::class, 'connector'])->name('infra.connector');
        Route::post('management-infrastructure-connector', [InfraController::class, 'connector_store'])->name('infra.connector.store');
        Route::post('management-infrastructure-connector-edit', [InfraController::class, 'connector_edit'])->name('infra.connector.edit');



        //Switch Tenants


        Route::post('switch-tenants', [TenantController::class, 'SwitchTenant'])->name('switch.tenants');
        Route::get('tenants-profile', [TenantController::class, 'TenantProfile'])->name('tenants.profile');
        Route::post('create-tenants-profile', [TenantController::class, 'CreateTenantProfile'])->name('tenant.create');


        //user password
        Route::post('update_credential', [\App\Http\Controllers\UserPageController::class, 'update_credential'])->name('change.user.password');

//
//        Route::resource('company', 'CompanyController', ['only' => ['list', 'update', 'edit']]);
//        Route::get('/company-staff', 'CompanyController@allstaff')->name('company.staff');
//        Route::get('/company-info', 'CompanyController@show')->name('company.info');
//
//
//        //Environment & Tier TODO store & update & edit
//        Route::resource('environment', 'EnvironmentController', ['only' => ['index', 'create', 'edit', 'store', 'update']]);
//
//        Route::resource('tier', 'TierController', ['only' => ['index', 'create', 'edit', 'store', 'update']]);
//
//        //operating-system
//        Route::resource('operating-system', 'OperatingSystemController', ['only' => ['create', 'update', 'edit', 'store']]);
//        Route::get('/operating-system', 'OperatingSystemController@list')->name('operating-system');





    });
/* Route Dashboards */

/* Route Apps */

// map leaflet
Route::get('/maps/leaflet', [ChartsController::class, 'maps_leaflet'])->name('map-leaflet');

// locale Route
Route::get('lang/{locale}', [LanguageController::class, 'swap']);

