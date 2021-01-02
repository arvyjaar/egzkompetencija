<?php

use App\Models\Role;
use Illuminate\Database\Seeder;

class RolesTableSeeder extends Seeder
{
    public function run()
    {
        $roles = [
            [
                'id' => 1,
                'title' => 'Admin',
                'created_at' => '2019-07-14 17:22:04',
                'updated_at' => '2019-07-14 17:22:04',
                'deleted_at' => null,
            ],
            [
                'id' => 2,
                'title' => 'Employee',
                'created_at' => '2019-07-14 17:22:04',
                'updated_at' => '2019-07-14 17:22:04',
                'deleted_at' => null,
            ],
            [
                'id' => 3,
                'title' => 'Observer',
                'created_at' => '2019-07-14 17:22:04',
                'updated_at' => '2019-07-14 17:22:04',
                'deleted_at' => null,
            ],
            [
                'id' => 4,
                'title' => 'Manager',
                'created_at' => '2019-07-14 17:22:04',
                'updated_at' => '2019-07-14 17:22:04',
                'deleted_at' => null,
            ]
        ];

        Role::insert($roles);
    }
}
