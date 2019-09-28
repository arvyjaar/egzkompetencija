<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;
use Carbon\Carbon;

class CategoriesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categories = [
            [
                'title'         => 'Bendravimas',
                'created_at'    => Carbon::now()->format('Y-m-d H:i:s'),
            ],
            [
                'title'         => 'Pasirengimas egzaminui',
                'created_at'    => Carbon::now()->format('Y-m-d H:i:s'),
            ],
            [
                'title'         => 'Elgesys egzamino metu',
                'created_at'    => Carbon::now()->format('Y-m-d H:i:s'),
            ],
            [
                'title'         => 'Egzamino rezultato pateikimas',
                'created_at'    => Carbon::now()->format('Y-m-d H:i:s'),
            ],
            [
                'title'         => 'Egzamino ataskaitos pildymas',
                'created_at'    => Carbon::now()->format('Y-m-d H:i:s'),
            ],
        ];

        DB::table('categories')->insert($categories);
    }
}
