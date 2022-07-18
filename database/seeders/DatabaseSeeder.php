<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        \App\Models\OperationCost::factory(1)->create(0);
       // \App\Models\CostCategory::factory(10)->create(0);
        //$this->factory(\App\Models\Project::class, 10000)->create();
        //$this->call(UsersTableSeeder::class);
        //D $this->call(DepartmentsSeeder::class);
        \App\Models\Project::factory(10000)->create();
        //$this->call(OperationCostTablesSeeder::Class);
        //$this->call(CostPaymentProfilesSeeder::Class);
        //$this->call(CostTypeProfilesSeeder::Class);
        //$this->call(CostProfileSeeder::Class);
        //$this->call(EnvironmentSeeder::Class);
        //$this->call(TierSeeder::Class);
        //$this->call(ProjectsTableSeeder::Class);
    }
}
