<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class WorktypesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $worktypes = [
            [
                'title' => 'EGZ',
                'description' => 'Egzaminai',
                'created_at' => '2019-07-20 00:00:00'
            ],
            [
                'title' => 'TPR',
                'description' => 'TP registracija',
                'created_at' => '2019-07-20 00:00:00'
            ]
        ];
        DB::table('worktypes')->insert($worktypes);
    }
}
