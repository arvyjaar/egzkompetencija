<?php

use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class FormsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $forms = [
            [
            'title' => 'Egzkompetencija',
            'worktype_id' => 1,
            'version' => '2018',
            'active' => 1,
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            ],
            [
            'title' => 'TPR sprendimas',
            'worktype_id' => 2,
            'version' => '2020',
            'active' => 0,
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            ],
        ];
       
        DB::table('forms')->insert($forms);
    }
}
