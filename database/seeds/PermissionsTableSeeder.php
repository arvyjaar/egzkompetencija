<?php

use App\Permission;
use Illuminate\Database\Seeder;

class PermissionsTableSeeder extends Seeder
{
    public function run()
    {
        $permissions = [[
            'id'         => '1',
            'title'      => 'user_management_access',
            'created_at' => '2019-07-21 15:26:45',
            'updated_at' => '2019-07-21 15:26:45',
        ],
            [
                'id'         => '2',
                'title'      => 'permission_create',
                'created_at' => '2019-07-21 15:26:45',
                'updated_at' => '2019-07-21 15:26:45',
            ],
            [
                'id'         => '3',
                'title'      => 'permission_edit',
                'created_at' => '2019-07-21 15:26:45',
                'updated_at' => '2019-07-21 15:26:45',
            ],
            [
                'id'         => '4',
                'title'      => 'permission_show',
                'created_at' => '2019-07-21 15:26:45',
                'updated_at' => '2019-07-21 15:26:45',
            ],
            [
                'id'         => '5',
                'title'      => 'permission_delete',
                'created_at' => '2019-07-21 15:26:45',
                'updated_at' => '2019-07-21 15:26:45',
            ],
            [
                'id'         => '6',
                'title'      => 'permission_access',
                'created_at' => '2019-07-21 15:26:45',
                'updated_at' => '2019-07-21 15:26:45',
            ],
            [
                'id'         => '7',
                'title'      => 'role_create',
                'created_at' => '2019-07-21 15:26:45',
                'updated_at' => '2019-07-21 15:26:45',
            ],
            [
                'id'         => '8',
                'title'      => 'role_edit',
                'created_at' => '2019-07-21 15:26:45',
                'updated_at' => '2019-07-21 15:26:45',
            ],
            [
                'id'         => '9',
                'title'      => 'role_show',
                'created_at' => '2019-07-21 15:26:45',
                'updated_at' => '2019-07-21 15:26:45',
            ],
            [
                'id'         => '10',
                'title'      => 'role_delete',
                'created_at' => '2019-07-21 15:26:45',
                'updated_at' => '2019-07-21 15:26:45',
            ],
            [
                'id'         => '11',
                'title'      => 'role_access',
                'created_at' => '2019-07-21 15:26:45',
                'updated_at' => '2019-07-21 15:26:45',
            ],
            [
                'id'         => '12',
                'title'      => 'user_create',
                'created_at' => '2019-07-21 15:26:45',
                'updated_at' => '2019-07-21 15:26:45',
            ],
            [
                'id'         => '13',
                'title'      => 'user_edit',
                'created_at' => '2019-07-21 15:26:45',
                'updated_at' => '2019-07-21 15:26:45',
            ],
            [
                'id'         => '14',
                'title'      => 'user_show',
                'created_at' => '2019-07-21 15:26:45',
                'updated_at' => '2019-07-21 15:26:45',
            ],
            [
                'id'         => '15',
                'title'      => 'user_delete',
                'created_at' => '2019-07-21 15:26:45',
                'updated_at' => '2019-07-21 15:26:45',
            ],
            [
                'id'         => '16',
                'title'      => 'user_access',
                'created_at' => '2019-07-21 15:26:45',
                'updated_at' => '2019-07-21 15:26:45',
            ],
            [
                'id'         => '17',
                'title'      => 'monitoring_report_create',
                'created_at' => '2019-07-21 15:26:45',
                'updated_at' => '2019-07-21 15:26:45',
            ],
            [
                'id'         => '18',
                'title'      => 'monitoring_report_edit',
                'created_at' => '2019-07-21 15:26:45',
                'updated_at' => '2019-07-21 15:26:45',
            ],
            [
                'id'         => '19',
                'title'      => 'monitoring_report_show',
                'created_at' => '2019-07-21 15:26:45',
                'updated_at' => '2019-07-21 15:26:45',
            ],
            [
                'id'         => '20',
                'title'      => 'monitoring_report_delete',
                'created_at' => '2019-07-21 15:26:45',
                'updated_at' => '2019-07-21 15:26:45',
            ],
            [
                'id'         => '21',
                'title'      => 'monitoring_report_access',
                'created_at' => '2019-07-21 15:26:45',
                'updated_at' => '2019-07-21 15:26:45',
            ],
            [
                'id'         => '22',
                'title'      => 'point_create',
                'created_at' => '2019-07-21 15:26:45',
                'updated_at' => '2019-07-21 15:26:45',
            ],
            [
                'id'         => '23',
                'title'      => 'point_edit',
                'created_at' => '2019-07-21 15:26:45',
                'updated_at' => '2019-07-21 15:26:45',
            ],
            [
                'id'         => '24',
                'title'      => 'point_show',
                'created_at' => '2019-07-21 15:26:45',
                'updated_at' => '2019-07-21 15:26:45',
            ],
            [
                'id'         => '25',
                'title'      => 'point_delete',
                'created_at' => '2019-07-21 15:26:45',
                'updated_at' => '2019-07-21 15:26:45',
            ],
            [
                'id'         => '26',
                'title'      => 'point_access',
                'created_at' => '2019-07-21 15:26:45',
                'updated_at' => '2019-07-21 15:26:45',
            ],
            [
                'id'         => '27',
                'title'      => 'criterion_create',
                'created_at' => '2019-07-21 15:26:45',
                'updated_at' => '2019-07-21 15:26:45',
            ],
            [
                'id'         => '28',
                'title'      => 'criterion_edit',
                'created_at' => '2019-07-21 15:26:45',
                'updated_at' => '2019-07-21 15:26:45',
            ],
            [
                'id'         => '29',
                'title'      => 'criterion_show',
                'created_at' => '2019-07-21 15:26:45',
                'updated_at' => '2019-07-21 15:26:45',
            ],
            [
                'id'         => '30',
                'title'      => 'criterion_delete',
                'created_at' => '2019-07-21 15:26:45',
                'updated_at' => '2019-07-21 15:26:45',
            ],
            [
                'id'         => '31',
                'title'      => 'criterion_access',
                'created_at' => '2019-07-21 15:26:45',
                'updated_at' => '2019-07-21 15:26:45',
            ],
            [
                'id'         => '32',
                'title'      => 'evaluation_create',
                'created_at' => '2019-07-21 15:26:45',
                'updated_at' => '2019-07-21 15:26:45',
            ],
            [
                'id'         => '33',
                'title'      => 'evaluation_edit',
                'created_at' => '2019-07-21 15:26:45',
                'updated_at' => '2019-07-21 15:26:45',
            ],
            [
                'id'         => '34',
                'title'      => 'evaluation_show',
                'created_at' => '2019-07-21 15:26:45',
                'updated_at' => '2019-07-21 15:26:45',
            ],
            [
                'id'         => '35',
                'title'      => 'evaluation_delete',
                'created_at' => '2019-07-21 15:26:45',
                'updated_at' => '2019-07-21 15:26:45',
            ],
            [
                'id'         => '36',
                'title'      => 'evaluation_access',
                'created_at' => '2019-07-21 15:26:45',
                'updated_at' => '2019-07-21 15:26:45',
            ],
            [
                'id'         => '37',
                'title'      => 'competency_access',
                'created_at' => '2019-07-21 15:26:45',
                'updated_at' => '2019-07-21 15:26:45',
            ],
            [
                'id'         => '38',
                'title'      => 'tool_create',
                'created_at' => '2019-07-21 15:26:45',
                'updated_at' => '2019-07-21 15:26:45',
            ],
            [
                'id'         => '39',
                'title'      => 'tool_edit',
                'created_at' => '2019-07-21 15:26:45',
                'updated_at' => '2019-07-21 15:26:45',
            ],
            [
                'id'         => '40',
                'title'      => 'tool_show',
                'created_at' => '2019-07-21 15:26:45',
                'updated_at' => '2019-07-21 15:26:45',
            ],
            [
                'id'         => '41',
                'title'      => 'tool_delete',
                'created_at' => '2019-07-21 15:26:45',
                'updated_at' => '2019-07-21 15:26:45',
            ],
            [
                'id'         => '42',
                'title'      => 'tool_access',
                'created_at' => '2019-07-21 15:26:45',
                'updated_at' => '2019-07-21 15:26:45',
            ]];

        Permission::insert($permissions);
    }
}
