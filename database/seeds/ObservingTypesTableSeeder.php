<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class ObservingTypesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $titles = ['Procedūra', 'Video'];
        foreach($titles as $t) {
            $types[] = [
                'title' => $t,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            ];
        }
        DB::table('observing_types')->insert($types);
    }
}
