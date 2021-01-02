<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class FormCompetencyPivotTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach(range(1, 5) as $index) {
            $entries[] = [
                'form_id' => 1,
                'competency_id' => $index,
                'created_at' => '2020-12-31 00:00:00'
            ];
        };
        
        DB::table('form_competency')->insert($entries);
    }
}
