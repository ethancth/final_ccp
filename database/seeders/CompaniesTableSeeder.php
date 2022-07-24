<?php

namespace Database\Seeders;

use App\Models\Company;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CompaniesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        Company::factory()->count(5)->create();
        $company = Company::find(1);
        $company->name = 'Super Admin';
        $company->domain = 'local.com';
        $company->slug = 'local.com';
        $company->save();
    }
}
