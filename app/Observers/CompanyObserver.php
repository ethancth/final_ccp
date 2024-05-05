<?php

namespace App\Observers;

use App\Models\BusinessUnit;
use App\Models\Company;
use App\Models\CostProfile;
use App\Models\Department;
use App\Models\Environment;
use App\Models\OperatingSystem;
use App\Models\ServiceApplication;
use App\Models\SystemType;
use App\Models\Tier;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class CompanyObserver
{

    // creating, created, updating, updated, saving,
    // saved,  deleting, deleted, restoring, restored

    public function created(Company $company)
    {
       // dd($company);
        $_companyid=$company->id;
        $_company_master_id=$company->master_id;
        $u=User::find($_company_master_id);
        $u->introduction='Admin';
        $u->save();

        Tier::create([
            'name' => "Default",
            'display_name' => "Default",
            'display_description' => "Default ",
            'display_icon'=>"alert-triangle",
            'display_icon_colour'=>"danger",
            'company_id'=>$company->id,
            'is_default'=>1,
            'status' => 1
        ]);

        Tier::create([
            'name' => "W",
            'display_name' => "Wintel",
            'display_description' => "Wintel ",
            'display_icon'=>"briefcase",
            'display_icon_colour'=>"info",
            'company_id'=>$company->id,
            'is_default'=>1,
            'status' => 1
        ]);
        Tier::create([
            'name' => "D",
            'display_name' => "Database",
            'display_description' => "Database",
            'display_icon'=>"layers",
            'display_icon_colour'=>"success",
            'company_id'=>$company->id,
            'is_default'=>1,
            'status' => 1
        ]);
        Tier::create([
            'name' => "Z",
            'display_name' => "DMZ",
            'display_description' => "DMZ",
            'display_icon'=>"chevrons-up",
            'display_icon_colour'=>"danger",
            'company_id'=>$company->id,
            'is_default'=>1,
            'status' => 1
        ]);


        Environment::create([
            'name' => "Default",
            'display_name' => "Default",
            'display_description' => "Default ",
            'display_icon'=>"alert-triangle",
            'display_icon_colour'=>"danger",
            'company_id'=>$company->id,
            'is_default'=>1,
            'status' => 1
        ]);
        Environment::create([
            'name' => "D",
            'display_name' => "Development",
            'display_description' => "Development - System Generate ",
            'display_icon'=>"layout",
            'display_icon_colour'=>"info",
            'company_id'=>$company->id,
            'is_default'=>1,
            'status' => 1
        ]);

        Environment::create([
            'name' => "U",
            'display_name' => "User Acceptance Test",
            'display_description' => "User Acceptance Test - System Generate ",
            'display_icon'=>"package",
            'display_icon_colour'=>"info",
            'company_id'=>$company->id,
            'is_default'=>1,
            'status' => 1
        ]);
        Environment::create([
            'name' => "S",
            'display_name' => "System Integration Test",
            'display_description' => "System Integration Test - System Generate ",
            'display_icon'=>"package",
            'display_icon_colour'=>"info",
            'company_id'=>$company->id,
            'is_default'=>1,
            'status' => 1
        ]);

        SystemType::create([
            'name' => "Default",
            'display_name' => "Default",
            'display_description' => "Default ",
            'display_icon'=>"alert-triangle",
            'display_icon_colour'=>"danger",
            'company_id'=>$company->id,
            'is_default'=>1,
            'status' => 1
        ]);

       SystemType::create([
           'name' => "WEB",
           'display_name' => "Web Server",
           'display_description' => "Web Server - System Generate ",
           'display_icon'=>"package",
           'display_icon_colour'=>"info",
           'company_id'=>$company->id,
           'is_default'=>1,
           'status' => 1
       ]);
        SystemType::create([
            'name' => "APP",
            'display_name' => "Application",
            'display_description' => "Application - System Generate ",
            'display_icon'=>"package",
            'display_icon_colour'=>"info",
            'company_id'=>$company->id,
            'is_default'=>1,
            'status' => 1
        ]);
        SystemType::create([
            'name' => "DBS",
            'display_name' => "Database",
            'display_description' => "Database - System Generate ",
            'display_icon'=>"database",
            'display_icon_colour'=>"info",
            'company_id'=>$company->id,
            'is_default'=>1,
            'status' => 1
        ]);
        SystemType::create([
            'name' => "DMZ",
            'display_name' => "DMZ",
            'display_description' => "DMZ - System Generate ",
            'display_icon'=>"package",
            'display_icon_colour'=>"info",
            'company_id'=>$company->id,
            'is_default'=>1,
            'status' => 1
        ]);

        BusinessUnit::create([
            'name' => "Default",
            'display_name' => "Default",
            'display_description' => "Default ",
            'display_icon'=>"alert-triangle",
            'display_icon_colour'=>"danger",
            'company_id'=>$company->id,
            'is_default'=>1,
            'status' => 1
        ]);

        BusinessUnit::create([
                'name' => "CB",
                'display_name' => "Consumer Bank",
                'display_description' => "Consumer Bank - System Generate ",
                'display_icon'=>"package",
                'display_icon_colour'=>"info",
                'company_id'=>$company->id,
                'is_default'=>1,
                'status' => 1
            ]
        );
        BusinessUnit::create([
                'name' => "WB",
                'display_name' => "Wholesales Bank",
                'display_description' => "Consumer Bank - System Generate ",
                'display_icon'=>"package",
                'display_icon_colour'=>"info",
                'company_id'=>$company->id,
                'is_default'=>1,
                'status' => 1
            ]
        );
        BusinessUnit::create([
                'name' => "GS",
                'display_name' => "Global Securities",
                'display_description' => "Global Securities - System Generate ",
                'display_icon'=>"package",
                'display_icon_colour'=>"info",
                'company_id'=>$company->id,
                'is_default'=>1,
                'status' => 1
            ]
        );
        BusinessUnit::create([
                'name' => "GM",
                'display_name' => "Group Asset Management",
                'display_description' => "Group Asset Management - System Generate ",
                'display_icon'=>"package",
                'display_icon_colour'=>"info",
                'company_id'=>$company->id,
                'is_default'=>1,
                'status' => 1
            ]
        );

        CostProfile::create([
            'name' => "Default Cost Profile",
            'description' => "Default Cost Profile - System Generatenew",
            'company_id'=>$_companyid,
            'vstorage'=>1,
            'is_master' => 1,
            'vcpu_price' => '12.95',
            'vmen_price' => '9.72',
            'vstorage_price' => '0.08',
            'form_vcpu_min' =>'2',
            'form_vcpu_max' =>'32',
            'form_vmen_min' =>'4',
            'form_vmen_max' =>'64',
            'form_vstorage_min' =>'150',

            'status' => 1

        ]);
        OperatingSystem::create([
            'name' => "WIN2016",
            'display_name' => "Window Server 2016",
            'display_description' => "System Generate",
            'company_id'=>$company->id,
            'os_type'=>'windows',
            'display_icon'=>'windows',
            'cost'=>'206.82',
            'is_default'=>1,
            'status' => 1
        ]);
        OperatingSystem::create([
            'name' => "WIN2019",
            'display_name' => "Window Server 2019",
            'display_description' => "System Generate",
            'company_id'=>$company->id,
            'os_type'=>'windows',
            'display_icon'=>'windows',
            'cost'=>'206.82',
            'is_default'=>1,
            'workflow_id'=>'408a543f-576d-4f10-9386-d2dd87312300',
            'status' => 1
        ]);
        OperatingSystem::create([
            'name' => "RHEL",
            'display_name' => "Rhel Server ",
            'display_description' => "System Generate",
            'company_id'=>$company->id,
            'os_type'=>'rhel',
            'display_icon'=>'rhel',
            'cost'=>'213.55',
            'is_default'=>1,
            'status' => 1
        ]);



        $records_department = [
            [
                "name"  => "Sales"
            ],
            [
                "name"  => "Marketing"
            ],
            [
                "name"  => "Human Resources"
            ],
            [
                "name"  => "Finance"
            ], [
                "name"  => "Information Technology (IT)"
            ],
            [
                "name"  => "Customer Service"
            ],
            [
                "name"  => "Research and Development (R&D)"
            ],
            [
                "name"  => "Operations"
            ],
            [
                "name"  => "Supply Chain Management"
            ],
            [
                "name"  => "Legal"
            ],
            [
                "name"  => "Quality Assurance"
            ],
            [
                "name"  => "Public Relations (PR)"
            ],
            [
                "name"  => "Administration"
            ],
            [
                "name"  => "Product Development"
            ],
            [
                "name"  => "Procurement"
            ]
            ];

        $records = [
            [
                "name"  => "SQL Server Developer Edition",
                "description"   => "",
                "onetime"   => "1",
                "costpercore"   => "0",
                "core"   => "0",
                "cost" => "0"
            ],
            [
                "name"  => "SQL Server Standard Edition",
                "description"   => "",
                "onetime"   => "0",
                "costpercore"   => "1",
                "core"   => "1",
                "cost" => "180.77"
            ], [
                "name"  => "SQL Server Enterprise Edition",
                "description"   => "",
                "onetime"   => "0",
                "costpercore"   => "1",
                "core"   => "1",
                "cost" => "693.29"
            ], [
                "name"  => "Red Hat OpenShift Platform Plus, Premium",
                "description"   => "",
                "onetime"   => "0",
                "costpercore"   => "1",
                "core"   => "1",
                "cost" => "373.31"
            ]


        ];
        foreach ($records as $result)
        {

            ServiceApplication::create(
                [
                    'name' => strtolower(preg_replace('/\s*/', '', $result['name'])),
                    'display_name' => $result['name'],
                    'cost' => $result['cost'],
                    'display_description' => $result['name'],
                    'company_id' => $company->id,
                    'status' => 1,
                    'is_one_time_payment' => $result['onetime'],
                    'is_cost_per_core' => $result['costpercore'],
                    'cpu_amount' =>$result['core'],
                    'is_default'=>1
                ]);
        }

//        foreach ($records_department as $result)
//        {
//
//            Department::create(
//                [
//                    'department_name' => $result['name'],
//                    'company_id' => $company->id,
//                    'slug' =>  Str::slug($result['name']),
//                    'total_member' => 0,
//                    'total_hod' => 0,
//                    'display_hod' => '',
//                    'hod_id' => '',
//                    'all_uid' =>'',
//                    'is_default' =>1,
//                ]);
//        }







    }
}
