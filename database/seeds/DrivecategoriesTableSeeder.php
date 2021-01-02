<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class DrivecategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $titles = ['B', 'A1', 'A2', 'A', 'B1', 'C1', 'D1', 'BE', 'B', 'B96', 'CE', 'DE', 'C1E', 'D1E'];
        foreach($titles as $t) {
            $categories[] = [
                'title'         => $t,
                'created_at'    => Carbon::now()->format('Y-m-d H:i:s'),
            ];
        }
        DB::table('drivecategories')->insert($categories);
    }
}
