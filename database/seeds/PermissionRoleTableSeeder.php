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

        // Examiner
        $employee_permissions = $admin_permissions->filter(function ($permission) {
            return substr($permission->title, 0, 24) == 'report_access' || substr($permission->title, 0, 11) == 'competency_';
        });
        Role::findOrFail(2)->permissions()->sync($employee_permissions);

        // EVPIS
        Role::findOrFail(4)->permissions()->sync($employee_permissions);

        // Observer
        $user_permissions = $admin_permissions->filter(function ($permission) {
            return substr($permission->title, 0, 18) == 'monitoring_report_' || substr($permission->title, 0, 11) == 'competency_';
        });
        Role::findOrFail(3)->permissions()->sync($user_permissions);
    }
}
