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
        Permission::create(['name' => 'project.*']);
        Permission::create(['name' => 'approver_reject_level_1']);
        Permission::create(['name' => 'approver_reject_level_2']);
        Permission::create(['name' => 'management']);

        // create roles and assign existing permissions
        $role1 = Role::create(['name' => 'Requester']);
        $role1->givePermissionTo('project.*');

        $role2 = Role::create(['name' => 'Approver_lv_1']);
        $role2->givePermissionTo('approver_reject_level_1');

        $role3 = Role::create(['name' => 'Approver_lv_2']);
        $role3->givePermissionTo('approver_reject_level_2');

        $role4 = Role::create(['name' => 'Admin']);
        $role4->givePermissionTo('management');
    }
}
