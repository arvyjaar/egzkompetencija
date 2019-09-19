<?php

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


class PointsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $points = [
            [
                'value'         => '0',
                'title'         => 'Nevertinta',
                'created_at'    => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                'value'         => '1',
                'title'         => 'Nepriimtina',
                'created_at'    => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                'value'         => '2',
                'title'         => 'Reikia tobulinti',
                'created_at'    => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                'value'         => '3',
                'title'         => 'Patenkinamai',
                'created_at'    => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                'value'         => '4',
                'title'         => 'Gerai',
                'created_at'    => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                'value'         => '5',
                'title'         => 'Puikiai (pavyzdys)',
                'created_at'    => Carbon::now()->format('Y-m-d H:i:s')
            ],

        ];

        DB::table('points')->insert($points);
    }
}
