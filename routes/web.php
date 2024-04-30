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
use Illuminate\Support\Facades\Auth;
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



Route::group(['middleware' => ['role:Admin']], function () {
    // Routes accessible only to users with the 'admin' role

    Route::get('/management-environment', [CompanyFormController::class, 'envform'])->name('management_env');
    Route::post('/management-environment', [CompanyFormController::class, 'env_request'])->name('management.env.store');
    Route::post('/management-environment-edit', [CompanyFormController::class, 'env_edit'])->name('management.env.edit');
    Route::post('/management-environment-delete', [CompanyFormController::class, 'env_delete'])->name('management.env.delete');


    //Infrastructure
    Route::get('management-infrastructure-connector', [InfraController::class, 'connector'])->name('infra.connector');
    Route::post('management-infrastructure-connector', [InfraController::class, 'connector_store'])->name('infra.connector.store');
    Route::post('management-infrastructure-connector-edit', [InfraController::class, 'connector_edit'])->name('infra.connector.edit');

    //Cost Profile
    Route::resource('cost-profile', CostProfileController::class, ['only' => ['create', 'update', 'edit', 'store']]);
    Route::get('/cost-profile', [CostProfileController::class,'index'])->name('cost-profile');
//

    //Department
    Route::get('/management-department', [DepartmentController::class, 'show'])->name('department.show');
    Route::post('/management-department',[DepartmentController::class,'store'])->name('department.store');
    Route::post('/management-department-edit', [DepartmentController::class, 'edit'])->name('department.edit');
    Route::post('/management-department-delete', [DepartmentController::class, 'delete_department'])->name('department.delete');

    //Tier
    Route::get('/management-cluster', [CompanyFormController::class, 'tierform'])->name('management_tier');
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
    Route::get('/management-infra', [CompanyFormController::class, 'infraform'])->name('management_vra_setting');
    Route::post('/management-infra', [CompanyFormController::class, 'infra_store'])->name('management.infra.store');
    Route::post('/management-costform', [CompanyFormController::class, 'costform_store'])->name('management.costform.store');
    Route::post('/management-company', [CompanyFormController::class, 'companyform_store'])->name('management.company.store');

    //policy Form
    Route::get('/management-policy-form', [CompanyFormController::class, 'policyform'])->name('management_policyform');
    Route::post('/management-policy-form', [CompanyFormController::class, 'policyform_store'])->name('management_policyform.store');
    Route::delete('/management-policy-form', [CompanyFormController::class, 'policyform_destroy'])->name('management_policyform.destroy');

    Route::get('/aria/api/token',[\App\Http\Controllers\AriaController::class,'trigger_workflow'])->name('aria.token');



});


Route::group(['middleware' => ['permission:approver_level_1']], function () {
    // Routes accessible only to users with the 'admin' role

    Route::get('/project/{project}/{slug?}/document', [ProjectController::class,'project_document'])->name('project.document');
    Route::post('/approveproject', [ProjectController::class, 'approveproject'])->name('project.approve');
    Route::post('/rejectproject', [ProjectController::class, 'rejectproject'])->name('project.reject');
    Route::post('/project-server-update-infra', [ProjectController::class, 'update_server_infra'])->name('project.server.update.infra');

    Route::get('/project/{project}/{slug?}', [ProjectController::class, 'show'])->name('project.show');
    Route::get('/project/{project}/{slug?}', [ProjectController::class, 'showjson'])->name('project.show.json');

});



Route::group(['middleware' => ['permission:approver_level_2']], function () {
    // Routes accessible only to users with the 'admin' role

    Route::post('/approveprojectl2', [ProjectController::class, 'approveprojectl2'])->name('project.approve.lv2');
    Route::post('/rejectproject', [ProjectController::class, 'rejectproject'])->name('project.reject');
});


Route::group(['middleware' => ['permission:approver_level_3']], function () {
    // Routes accessible only to users with the 'admin' role

    Route::post('/approveprojectl3', [ProjectController::class, 'approveprojectl3'])->name('project.approve.lv3');
    Route::post('/rejectproject', [ProjectController::class, 'rejectproject'])->name('project.reject');
});

Route::group(['middleware' => ['permission:approver_bau_level_3']], function () {
    // Routes accessible only to users with the 'admin' role

    Route::post('/approveprojectl3', [ProjectController::class, 'approveprojectl3'])->name('project.approve.lv3');
    Route::post('/rejectproject', [ProjectController::class, 'rejectproject'])->name('project.reject');
});



Auth::routes(['verify' => true]);
Route::group(['middleware' => ['auth', 'verified']],
    function () {
// Route Dashboards



        Route::get('/', [ProjectController::class, 'index'])->name('dashboard');


//
//
        //filter Policy
        Route::get('/filter-policy-form', [CompanyFormController::class, 'getMandatoryService'])->name('filter_policy');
        Route::get('/get-service-name', [CompanyFormController::class, 'getServiceName'])->name('service_name');

        //server Cost
        Route::get('/get-cost', [CompanyFormController::class, 'getCost'])->name('server_cost');
        Route::get('/get-os_disk', [CompanyFormController::class, 'get_os_disk'])->name('server_os_disk');


        //Livewire


        //Search

        Route::get('getCompanyDomain', [\App\Http\Controllers\SearchController::class, 'getCompanyDomain'])->name('getCompanyDomain');
//        //Project

        Route::get('/project', [ProjectController::class, 'index'])->name('project');
        Route::post('/project_check_status', [ProjectController::class, 'project_check_status'])->name('project.check.status');
        Route::get('/projectjson', [ProjectController::class, 'index'])->name('project');
     //   Route::post('/project', [ProjectController::class, 'store'])->name('project.store');
        Route::delete('/project/{id}', [ProjectController::class, 'projectdestroy'])->name('project.destroy');
     //   Route::post('/project', [ProjectController::class, 'storeprojectsg'])->name('project.securitygroup.store');
        Route::post('/submitproject', [ProjectController::class, 'submitproject'])->name('project.submit');

        Route::get('/project/{project}/{slug?}', [ProjectController::class, 'show'])->name('project.show');
//        Route::get('/project/{project}/{slug?}', [ProjectController::class, 'showjson'])->name('project.show.json');

        Route::post('/projectserver', [ProjectController::class, 'storeserver'])->name('project.storeserver');

        Route::post('/editprojectserver', [ProjectController::class, 'edit'])->name('project.editserver');
        Route::post('/deleteprojectserver', [ProjectController::class, 'destroy'])->name('project.delete');




        Route::post('read_content', [DemoController::class, 'demo'])->name('demo');
        Route::get('read_available_service', [DemoController::class, 'getservice'])->name('getservice');
        Route::get('filter_network', [DemoController::class, 'getnetworkbycluster'])->name('getnetworkbycluster');
        Route::post('save_network', [ProjectController::class, 'store_network'])->name('store_network');
        Route::get('management-network', [\App\Http\Controllers\NetworkController::class, 'show_network'])->name('show_network');
        Route::post('sync_network', [\App\Http\Controllers\NetworkController::class, 'sync_network'])->name('sync_network');


        Route::post('get_security_group_member', [ProjectSecurityGroupController::class, 'getservice'])->name('get.psg.member');
        Route::post('update_security_group_member', [ProjectSecurityGroupController::class, 'getpsg_member_store'])->name('psg.member.store');



        Route::get('/user-management', [UserPageController::class, 'index'])->name('user');
        Route::post('/user-management', [UserPageController::class, 'store'])->name('user.store');
        Route::post('/user-management-edit', [UserPageController::class, 'edit'])->name('user.edit');
        Route::post('/user-management-remove-user', [UserPageController::class, 'remove_member'])->name('user.remove');

        //Server Object
        Route::get('server',[ServerController::class,'index'])->name('server');








        //Switch Tenants

//
        Route::post('switch-tenants', [TenantController::class, 'SwitchTenant'])->name('switch.tenants');
        Route::get('tenants-profile', [TenantController::class, 'TenantProfile'])->name('tenants.profile');
        Route::post('create-tenants-profile', [TenantController::class, 'CreateTenantProfile'])->name('tenant.create');


        //user password
        Route::post('update_credential', [\App\Http\Controllers\UserPageController::class, 'update_credential'])->name('change.user.password');





    });
/* Route Dashboards */

/* Route Apps */

// map leaflet

// locale Route
Route::get('lang/{locale}', [LanguageController::class, 'swap']);

