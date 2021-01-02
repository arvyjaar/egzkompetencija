<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;
use Carbon\Carbon;

class CompetenciesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $competencies = [
            [
                'title'         => 'Bendravimas',
                'worktype_id'   => 1,
                'created_at'    => Carbon::now()->format('Y-m-d H:i:s'),
            ],
            [
                'title'         => 'Pasirengimas egzaminui',
                'worktype_id'   => 1,
                'created_at'    => Carbon::now()->format('Y-m-d H:i:s'),
            ],
            [
                'title'         => 'Elgesys egzamino metu',
                'worktype_id'   => 1,
                'created_at'    => Carbon::now()->format('Y-m-d H:i:s'),
            ],
            [
                'title'         => 'Egzamino rezultato pateikimas',
                'worktype_id'   => 1,
                'created_at'    => Carbon::now()->format('Y-m-d H:i:s'),
            ],
            [
                'title'         => 'Egzamino ataskaitos pildymas',
                'worktype_id'   => 1,
                'created_at'    => Carbon::now()->format('Y-m-d H:i:s'),
            ],
        ];

        DB::table('competencies')->insert($competencies);
    }
}
