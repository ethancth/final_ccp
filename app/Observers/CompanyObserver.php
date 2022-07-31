<?php

namespace App\Observers;

use App\Models\Company;
use App\Models\CostProfile;
use App\Models\Environment;
use App\Models\Tier;

class CompanyObserver
{

    // creating, created, updating, updated, saving,
    // saved,  deleting, deleted, restoring, restored

    public function created(Company $company)
    {
        Environment::create([
                'name' => "Production",
                'display_name' => "Production",
                'display_description' => "Production - System Generate ",
                'display_icon'=>"Production - System Generate ",
                'display_icon_colour'=>"Production - System Generate ",
                'company_id'=>$company->id,
                'status' => 1
            ]);
        Environment::create([
            'name' => "Development",
            'display_name' => "Development",
            'display_description' => "Development - System Generate ",
            'display_icon'=>"Development - System Generate ",
            'display_icon_colour'=>"Development - System Generate ",
            'company_id'=>$company->id,
            'status' => 1
        ]);
        Environment::create([
            'name' => "Staging",
            'display_name' => "Staging",
            'display_description' => "Staging - System Generate ",
            'display_icon'=>"Staging - System Generate ",
            'display_icon_colour'=>"Staging - System Generate ",
            'company_id'=>$company->id,
            'status' => 1
        ]);

        Tier::create([
            'name' => "Web",
            'display_name' => "Web",
            'display_description' => "Web - System Generate ",
            'display_icon'=>"Web - System Generate ",
            'display_icon_colour'=>"Web - System Generate ",
            'company_id'=>$company->id,
            'status' => 1
        ]);

        Tier::create([
            'name' => "App",
            'display_name' => "App",
            'display_description' => "App - System Generate ",
            'display_icon'=>"App - System Generate ",
            'display_icon_colour'=>"App - System Generate ",
            'company_id'=>$company->id,
            'status' => 1
        ]);
        Tier::create([
            'name' => "Db",
            'display_name' => "Database",
            'display_description' => "Database - System Generate ",
            'display_icon'=>"Database - System Generate ",
            'display_icon_colour'=>"Database - System Generate ",
            'company_id'=>$company->id,
            'status' => 1
        ]);
        CostProfile::create([
            'name' => "Default Cost Profile",
            'description' => "Default Cost Profile - System Generate",
            'company_id'=>$company->id,
            'is_master' => 1,
            'status' => 1

        ]);





    }
}
