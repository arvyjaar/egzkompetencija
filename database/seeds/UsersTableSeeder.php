<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use Illuminate\Support\Facades\DB;
use App\Models\User;

class UsersTableSeeder extends Seeder
{
    public function run()
    {
        // Create 3 specific users
        $users = [
            [
                'name' => 'Admin Admin',
                'email' => 'admin@example.com',
                'password' => '$2y$10$L1Q41dc2cPndrFAXTOAf2uB9HIHUiiUcWQ33wZFquII7oCIXXla5W',
                'remember_token' => null,
                'branch_id' => '1',
                'created_at' => '2019-07-14 17:22:04',
                'updated_at' => '2019-07-14 17:22:04',
                'deleted_at' => null,
            ],
            [
                'name' => 'Manager Manager',
                'email' => 'manager@example.com',
                'password' => '$2y$10$kkKVG0SuIdecC5QpwUX11.jr56qrSxUHSTzKLz7L7Ohn/Nfj4yA3C',
                'remember_token' => null,
                'branch_id' => '1',
                'created_at' => '2019-07-14 17:22:04',
                'updated_at' => '2019-07-14 17:22:04',
                'deleted_at' => null,
            ],
                        [
                'name' => 'Observer Observer',
                'email' => 'observer@example.com',
                'password' => '$2y$10$8hcEsDE7qnuG0i5JRsPmiuQYg83BtkN75xvKl/z.ue3ghrjhR1x6K',
                'remember_token' => null,
                'branch_id' => '1',
                'created_at' => '2019-07-14 17:22:04',
                'updated_at' => '2019-07-14 17:22:04',
                'deleted_at' => null,
            ],
            [
                'name' => 'Employee Employee',
                'email' => 'employee@example.com',
                'password' => '$2y$10$kkKVG0SuIdecC5QpwUX11.jr56qrSxUHSTzKLz7L7Ohn/Nfj4yA3C',
                'remember_token' => null,
                'branch_id' => '1',
                'created_at' => '2019-07-14 17:22:04',
                'updated_at' => '2019-07-14 17:22:04',
                'deleted_at' => null,
            ],
        ];
        $users = User::insert($users);
        
        // Create more random users using model factory

        $users = User::factory()->count(200)->create();
    }
}
