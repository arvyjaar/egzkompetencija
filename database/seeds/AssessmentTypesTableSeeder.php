<?php

use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class AssessmentTypesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $assessments = [
            [
                'id' => 1,
                'title' => '0 / 1',
                'assessment_values' => json_encode([
                    ['title' => 'nevertinta', 'value' => 'N'], // unrated
                    ['title' => 'ne', 'value' => 0],
                    ['title' => 'taip', 'value' => 1],

                ]),
                'bad_values' => json_encode([
                    0,
                ]),
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            ],
            [
                'id' => 2,
                'title' => '1 - 5',
                'assessment_values' => json_encode([
                    ['title' => 'nevertinta', 'value' => 'N'], // unrated
                    ['title' => 'nepriimtina', 'value' => 1],
                    ['title' => 'blogai', 'value' => 2],
                    ['title' => 'patenkinamai', 'value' => 3],
                    ['title' => 'gerai', 'value' => 4],
                    ['title' => 'puikiai', 'value' => 5],
                ]),
                'bad_values' => json_encode([
                    1, 2,
                ]),
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            ],
        ];

        DB::table('assessment_types')->insert($assessments);
    }
}
