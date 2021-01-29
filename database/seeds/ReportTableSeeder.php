<?php

use Illuminate\Database\Seeder;
use App\Models\Criterion;
use App\Models\Report;
use Faker\Factory as Faker;

class ReportTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Report::factory()->count(500)->create();   
    }
}
