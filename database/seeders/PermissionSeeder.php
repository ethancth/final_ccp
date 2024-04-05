<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Spatie\Permission\PermissionRegistrar;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //

        app()[PermissionRegistrar::class]->forgetCachedPermissions();

        // create permissions
        Permission::firstOrCreate(['name' => 'project.update']);
        Permission::firstOrCreate(['name' => 'approver_reject_level_1']);
        Permission::firstOrCreate(['name' => 'approver_reject_level_2']);
        Permission::firstOrCreate(['name' => 'management']);

        // create roles and assign existing permissions
        $role1 = Role::firstOrCreate(['name' => 'Requester']);
        $role1->givePermissionTo('project.update');

        $role2 = Role::firstOrCreate(['name' => 'Approver_lv_1']);
        $role2->givePermissionTo('approver_reject_level_1');

        $role3 = Role::firstOrCreate(['name' => 'Approver_lv_2']);
        $role3->givePermissionTo('approver_reject_level_2');

        $role4 = Role::firstOrCreate(['name' => 'Admin']);
        $role4->givePermissionTo('management');
    }
}
