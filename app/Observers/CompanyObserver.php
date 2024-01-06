<?php

namespace App\Observers;

use App\Models\Company;
use App\Models\CostProfile;
use App\Models\Environment;
use App\Models\OperatingSystem;
use App\Models\ServiceApplication;
use App\Models\Tier;
use Illuminate\Support\Facades\Auth;

class CompanyObserver
{

    // creating, created, updating, updated, saving,
    // saved,  deleting, deleted, restoring, restored

    public function created(Company $company)
    {
       // dd($company);
        $_companyid=$company->id;
        Environment::create([
                'name' => "Production",
                'display_name' => "Production",
                'display_description' => "Production - System Generate ",
                'display_icon'=>"briefcase",
                'display_icon_colour'=>"info",
                'company_id'=>$company->id,
                'status' => 1
            ]);
        Environment::create([
            'name' => "Development",
            'display_name' => "Development",
            'display_description' => "Development - System Generate ",
            'display_icon'=>"layers",
            'display_icon_colour'=>"success",
            'company_id'=>$company->id,
            'status' => 1
        ]);
        Environment::create([
            'name' => "Staging",
            'display_name' => "Staging",
            'display_description' => "Staging - System Generate ",
            'display_icon'=>"chevrons-up",
            'display_icon_colour'=>"danger",
            'company_id'=>$company->id,
            'status' => 1
        ]);

        Tier::create([
            'name' => "Web",
            'display_name' => "Web",
            'display_description' => "Web - System Generate ",
            'display_icon'=>"layout",
            'display_icon_colour'=>"info",
            'company_id'=>$company->id,
            'status' => 1
        ]);

        Tier::create([
            'name' => "App",
            'display_name' => "App",
            'display_description' => "App - System Generate ",
            'display_icon'=>"package",
            'display_icon_colour'=>"danger",
            'company_id'=>$company->id,
            'status' => 1
        ]);
        Tier::create([
            'name' => "Db",
            'display_name' => "Database",
            'display_description' => "Database - System Generate ",
            'display_icon'=>"database",
            'display_icon_colour'=>"success",
            'company_id'=>$company->id,
            'status' => 1
        ]);
        CostProfile::create([
            'name' => "Default Cost Profile",
            'description' => "Default Cost Profile - System Generate",
            'company_id'=>$_companyid,
            'is_master' => 1,
            'status' => 1

        ]);
        OperatingSystem::create([
            'name' => "window2022",
            'display_name' => "Microsoft Window 2022 RC",
            'description' => "System Generate",
            'company_id'=>$company->id,
            'os_type'=>'windows',
            'display_icon'=>'windows',
            'cost'=>'10',
            'status' => 1
        ]);
        OperatingSystem::create([
            'name' => "RHEL7",
            'display_name' => "RHEL 7.4 build 3.10.0-693 ",
            'description' => "System Generate",
            'company_id'=>$company->id,
            'os_type'=>'rhel',
            'display_icon'=>'rhel',
            'cost'=>'9',
            'status' => 1
        ]);
        OperatingSystem::create([
            'name' => "Centos8",
            'display_name' => "Centos 8.5-2111",
            'description' => "System Generate",
            'company_id'=>$company->id,
            'os_type'=>'centos',
            'display_icon'=>'centos',
            'cost'=>'5',
            'status' => 1
        ]);



        $records = [
            [
                "name"  => "SQL Server 2019",
                "description"   => "",
                "onetime"   => "1",
                "costpercore"   => "0",
                "core"   => "0",
                "cost" => "1"
            ],
            [
                "name"  => "Oracle Database 19c",
                "description"   => "",
                "onetime"   => "1",
                "costpercore"   => "0",
                "core"   => "0",
                "cost" => "1"
            ], [
                "name"  => "Dynamics 365",
                "description"   => "",
                "onetime"   => "1",
                "costpercore"   => "0",
                "core"   => "0",
                "cost" => "1"
            ], [
                "name"  => "Tableau Desktop 2021.x ",
                "description"   => "",
                "onetime"   => "1",
                "costpercore"   => "0",
                "core"   => "0",
                "cost" => "1"
            ], [
                "name"  => "Adobe Experience Manager 6.5",
                "description"   => "",
                "onetime"   => "1",
                "costpercore"   => "0",
                "core"   => "0",
                "cost" => "1"
            ], [
                "name"  => "Jira Software 8.x",
                "description"   => "",
                "onetime"   => "1",
                "costpercore"   => "0",
                "core"   => "0",
                "cost" => "1"
            ],[
                "name"  => "Magento 2.x",
                "description"   => "",
                "onetime"   => "1",
                "costpercore"   => "0",
                "core"   => "0",
                "cost" => "1"
            ],[
                "name"  => "WordPress 5.x",
                "description"   => "",
                "onetime"   => "1",
                "costpercore"   => "0",
                "core"   => "0",
                "cost" => "1"
            ],[
                "name"  => "Moodle 3.x",
                "description"   => "",
                "onetime"   => "1",
                "costpercore"   => "0",
                "core"   => "0",
                "cost" => "1"
            ],[
                "name"  => "Symantec Endpoint Protection 14.x",
                "description"   => "",
                "onetime"   => "1",
                "costpercore"   => "0",
                "core"   => "0",
                "cost" => "1"
            ],[
                "name"  => "McAfee Endpoint Security 10.x",
                "description"   => "",
                "onetime"   => "1",
                "costpercore"   => "0",
                "core"   => "0",
                "cost" => "1"
            ],[
                "name"  => "MySQL 8.0",
                "description"   => "",
                "onetime"   => "1",
                "costpercore"   => "0",
                "core"   => "0",
                "cost" => "1"
            ],[
                "name"  => "PostgreSQL 13",
                "description"   => "",
                "onetime"   => "1",
                "costpercore"   => "0",
                "core"   => "0",
                "cost" => "1"
            ],[
                "name"  => "MongoDB 4.x",
                "description"   => "",
                "onetime"   => "1",
                "costpercore"   => "0",
                "core"   => "0",
                "cost" => "1"
            ],[
                "name"  => "MariaDB 10.5",
                "description"   => "",
                "onetime"   => "1",
                "costpercore"   => "0",
                "core"   => "0",
                "cost" => "1"
            ],[
                "name"  => "Apache Cassandra 3.x",
                "description"   => "",
                "onetime"   => "1",
                "costpercore"   => "0",
                "core"   => "0",
                "cost" => "1"
            ],[
                "name"  => "Redis 6.x",
                "description"   => "",
                "onetime"   => "1",
                "costpercore"   => "0",
                "core"   => "0",
                "cost" => "1"
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
                ]);
        }







    }
}
