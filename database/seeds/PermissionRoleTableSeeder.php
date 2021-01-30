<?php

use App\Models\Permission;
use App\Models\Role;
use Illuminate\Database\Seeder;

class PermissionRoleTableSeeder extends Seeder
{
    public function run()
    {
        $all_permissions = Permission::all();

        $admin_permissions = $all_permissions->filter(function ($permission) {
            return 
                substr($permission->title, 0, 11) == 'report_view'
                ||
                substr($permission->title, 0, 12) == 'manage_forms'
                ||
                substr($permission->title, 0, 14) == 'report_comment';
        });     
        Role::findOrFail(1)->permissions()->sync($admin_permissions->pluck('id'));

        // Manager
        $manager_permissions = $all_permissions->filter(function ($permission) {
            return 
                substr($permission->title, 0, 11) == 'report_view'
                ||
                substr($permission->title, 0, 12) == 'manage_forms'
                ||
                substr($permission->title, 0, 14) == 'report_comment';
        });
        Role::findOrFail(2)->permissions()->sync($manager_permissions);

        // Observer
        $observer_permissions = $all_permissions->filter(function ($permission) {
            return 
                substr($permission->title, 0, 13) == 'report_create';
        });
        Role::findOrFail(3)->permissions()->sync($observer_permissions);

        // Employee (2) no permissions
    }
}
