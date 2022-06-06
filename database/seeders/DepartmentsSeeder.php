<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DepartmentsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('departments')->insert([
            'department_name' => 'IT',
            'hod_id'=>'1',
        ]);
        DB::table('departments')->insert([
            'department_name' => 'DB',
            'hod_id'=>'2',
        ]);
        DB::table('departments')->insert([
            'department_name' => 'OS',
            'hod_id'=>'3',
        ]);
    }
}
