<?php

use App\Models\Permission;
use App\Models\Role;
use Illuminate\Database\Seeder;

class PermissionRoleTableSeeder extends Seeder
{
    public function run()
    {
        $admin_permissions = Permission::all();
        Role::findOrFail(1)->permissions()->sync($admin_permissions->pluck('id'));

        // Employee
        $employee_permissions = $admin_permissions->filter(function ($permission) {
            return substr($permission->title, 0, 13) == 'report_access';
        });
        Role::findOrFail(2)->permissions()->sync($employee_permissions);

        // Manager
        $manager_permissions = $admin_permissions->filter(function ($permission) {
            return 
               substr($permission->title, 0, 14) == 'criterion_edit' 
            || substr($permission->title, 0, 16) == 'criterion_access'
            || substr($permission->title, 0, 13) == 'report_access';
        });
        Role::findOrFail(4)->permissions()->sync($manager_permissions);

        // Observer
        $observer_permissions = $admin_permissions->filter(function ($permission) {
            return 
                substr($permission->title, 0, 13) == 'report_create'
            ||  substr($permission->title, 0, 13) == 'report_access';
        });
        Role::findOrFail(3)->permissions()->sync($observer_permissions);
    }
}
