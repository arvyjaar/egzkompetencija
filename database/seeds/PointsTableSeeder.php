<?php

use App\Point;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

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
                'description'   => 'Nevertinta',
                'created_at'    => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                'value'         => '1',
                'description'   => 'Nepriimtina',
                'created_at'    => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                'value'         => '2',
                'description'   => 'Reikia tobulinti',
                'created_at'    => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                'value'         => '3',
                'description'   => 'Patenkinamai',
                'created_at'    => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                'value'         => '4',
                'description'   => 'Gerai',
                'created_at'    => Carbon::now()->format('Y-m-d H:i:s')
            ],
            [
                'value'         => '5',
                'description'   => 'Puikiai',
                'created_at'    => Carbon::now()->format('Y-m-d H:i:s')
            ],

        ];

        Point::insert($points);    
    }
}
