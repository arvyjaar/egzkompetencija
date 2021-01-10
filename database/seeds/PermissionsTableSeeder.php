<?php

use App\Models\Permission;
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
                'title' => 'user_edit',
                'created_at' => '2019-07-21 15:26:45',
                'updated_at' => '2019-07-21 15:26:45',
            ],
                        [
                'title' => 'criterion_edit',
                'created_at' => '2019-07-21 15:26:45',
                'updated_at' => '2019-07-21 15:26:45',
            ],
            [
                'title' => 'criterion_access',
                'created_at' => '2019-07-21 15:26:45',
                'updated_at' => '2019-07-21 15:26:45',
            ],
            [
                'title' => 'report_create',
                'created_at' => '2019-07-21 15:26:45',
                'updated_at' => '2019-07-21 15:26:45',
            ],
            [
                'title' => 'report_access',
                'created_at' => '2019-07-21 15:26:45',
                'updated_at' => '2019-07-21 15:26:45',
            ],
            [
                'title' => 'report_show',
                'created_at' => '2019-07-21 15:26:45',
                'updated_at' => '2019-07-21 15:26:45',
            ],
        ];

        Permission::insert($permissions);
    }
}
