<?php

use App\Critcategory;
use Illuminate\Database\Seeder;
use Carbon\Carbon;

class CritcategorySeeder extends Seeder
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
                'title'         => 'Ataskaitos pildymas',
                'created_at'    => Carbon::now()->format('Y-m-d H:i:s'),
            ],
        ];

        Critcategory::insert($categories);
    }
}
