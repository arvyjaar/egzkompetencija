<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use Illuminate\Support\Facades\DB;

class UsersTableSeeder extends Seeder
{
    public function run()
    {
        $users = [
            [
                'name' => 'Admin',
                'email' => 'admin@admin.com',
                'password' => '$2y$10$L1Q41dc2cPndrFAXTOAf2uB9HIHUiiUcWQ33wZFquII7oCIXXla5W',
                'remember_token' => null,
                'branch_id' => '1',
                'created_at' => '2019-07-14 17:22:04',
                'updated_at' => '2019-07-14 17:22:04',
                'deleted_at' => null,
            ],
            [
                'name' => 'examiner',
                'email' => 'examiner@exam.com',
                'password' => '$2y$10$kkKVG0SuIdecC5QpwUX11.jr56qrSxUHSTzKLz7L7Ohn/Nfj4yA3C',
                'remember_token' => null,
                'branch_id' => '1',
                'created_at' => '2019-07-14 17:22:04',
                'updated_at' => '2019-07-14 17:22:04',
                'deleted_at' => null,
            ],
            [
                'name' => 'observer',
                'email' => 'observer@exam.com',
                'password' => '$2y$10$8hcEsDE7qnuG0i5JRsPmiuQYg83BtkN75xvKl/z.ue3ghrjhR1x6K',
                'remember_token' => null,
                'branch_id' => '1',
                'created_at' => '2019-07-14 17:22:04',
                'updated_at' => '2019-07-14 17:22:04',
                'deleted_at' => null,
            ],

        ];
        DB::table('users')->insert($users);

        $branch_count = DB::table('branches')->get()->count();
        $faker = Faker::create();

        $users = [];
        foreach (range(1,5) as $index) {
            $users[] = [
                'name' => $faker->name,
                'email' => $faker->unique()->safeEmail,
                'password' => bcrypt('password'),
                'remember_token' => null,
                'branch_id' => rand(1, $branch_count),
                'created_at' => '2019-07-14 17:22:04',
            ];
        };
        DB::table('users')->insert($users);
    }
}
