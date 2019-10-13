<?php

use App\Permission;
use Illuminate\Database\Seeder;

class PermissionsTableSeeder extends Seeder
{
    public function run()
    {
        $permissions = [
            [
                'title' => 'user_management_access',
                'created_at' => '2019-07-21 15:26:45',
                'updated_at' => '2019-07-21 15:26:45',
            ],
            [
                'title' => 'permission_create',
                'created_at' => '2019-07-21 15:26:45',
                'updated_at' => '2019-07-21 15:26:45',
            ],
            [
                'title' => 'permission_edit',
                'created_at' => '2019-07-21 15:26:45',
                'updated_at' => '2019-07-21 15:26:45',
            ],
            [
                'title' => 'permission_show',
                'created_at' => '2019-07-21 15:26:45',
                'updated_at' => '2019-07-21 15:26:45',
            ],
            [
                'title' => 'permission_delete',
                'created_at' => '2019-07-21 15:26:45',
                'updated_at' => '2019-07-21 15:26:45',
            ],
            [
                'title' => 'permission_access',
                'created_at' => '2019-07-21 15:26:45',
                'updated_at' => '2019-07-21 15:26:45',
            ],
            [
                'title' => 'role_create',
                'created_at' => '2019-07-21 15:26:45',
                'updated_at' => '2019-07-21 15:26:45',
            ],
            [
                'title' => 'role_edit',
                'created_at' => '2019-07-21 15:26:45',
                'updated_at' => '2019-07-21 15:26:45',
            ],
            [
                'title' => 'role_show',
                'created_at' => '2019-07-21 15:26:45',
                'updated_at' => '2019-07-21 15:26:45',
            ],
            [
                'title' => 'role_delete',
                'created_at' => '2019-07-21 15:26:45',
                'updated_at' => '2019-07-21 15:26:45',
            ],
            [
                'title' => 'role_access',
                'created_at' => '2019-07-21 15:26:45',
                'updated_at' => '2019-07-21 15:26:45',
            ],
            [
                'title' => 'user_create',
                'created_at' => '2019-07-21 15:26:45',
                'updated_at' => '2019-07-21 15:26:45',
            ],
            [
                'title' => 'user_edit',
                'created_at' => '2019-07-21 15:26:45',
                'updated_at' => '2019-07-21 15:26:45',
            ],
            [
                'title' => 'user_show',
                'created_at' => '2019-07-21 15:26:45',
                'updated_at' => '2019-07-21 15:26:45',
            ],
            [
                'title' => 'user_delete',
                'created_at' => '2019-07-21 15:26:45',
                'updated_at' => '2019-07-21 15:26:45',
            ],
            [
                'title' => 'user_access',
                'created_at' => '2019-07-21 15:26:45',
                'updated_at' => '2019-07-21 15:26:45',
            ],
            [
                'title' => 'competency_access',
                'created_at' => '2019-07-21 15:26:45',
                'updated_at' => '2019-07-21 15:26:45',
            ],
            [
                'title' => 'monitoring_report_create',
                'created_at' => '2019-07-21 15:26:45',
                'updated_at' => '2019-07-21 15:26:45',
            ],
            [
                'title' => 'monitoring_report_access',
                'created_at' => '2019-07-21 15:26:45',
                'updated_at' => '2019-07-21 15:26:45',
            ],
            [
                'title' => 'criterion_create',
                'created_at' => '2019-07-21 15:26:45',
                'updated_at' => '2019-07-21 15:26:45',
            ],
            [
                'title' => 'criterion_edit',
                'created_at' => '2019-07-21 15:26:45',
                'updated_at' => '2019-07-21 15:26:45',
            ],
            [
                'title' => 'criterion_show',
                'created_at' => '2019-07-21 15:26:45',
                'updated_at' => '2019-07-21 15:26:45',
            ],
            [
                'title' => 'criterion_delete',
                'created_at' => '2019-07-21 15:26:45',
                'updated_at' => '2019-07-21 15:26:45',
            ],
            [
                'title' => 'criterion_access',
                'created_at' => '2019-07-21 15:26:45',
                'updated_at' => '2019-07-21 15:26:45',
            ],
            [
                'title' => 'tool_create',
                'created_at' => '2019-07-21 15:26:45',
                'updated_at' => '2019-07-21 15:26:45',
            ],
            [
                'title' => 'tool_edit',
                'created_at' => '2019-07-21 15:26:45',
                'updated_at' => '2019-07-21 15:26:45',
            ],
            [
                'title' => 'tool_show',
                'created_at' => '2019-07-21 15:26:45',
                'updated_at' => '2019-07-21 15:26:45',
            ],
            [
                'title' => 'tool_delete',
                'created_at' => '2019-07-21 15:26:45',
                'updated_at' => '2019-07-21 15:26:45',
            ],
            [
                'title' => 'tool_access',
                'created_at' => '2019-07-21 15:26:45',
                'updated_at' => '2019-07-21 15:26:45',
            ]
        ];

        Permission::insert($permissions);
    }
}
