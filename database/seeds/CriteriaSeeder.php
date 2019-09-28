<?php

use App\Criterion;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class CriteriaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $criteria = [
            //Bendravimas
            [
                'title' => 'Pasitikęs egzaminuojamąjį, prisistato, į egzaminuojamąjį kreipiasi vardu',
                'category_id' => 1,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            ],
            [
                'title' => 'Pagarbiai elgiasi su egzaminuojamuoju, yra nešališkas',
                'category_id' => 1,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            ],
            [
                'title' => 'Nesukelia įtampos egzaminuojamajam, pozityviai nusiteikęs, sugeba tvardytis',
                'category_id' => 1,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            ],
            //Pasirengimas egzaminui
            [

                'title' => 'Padeda egzaminuojamajam susipažinti su transporto priemone',
                'category_id' => 2,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            ],
            [
                'title' => 'Apibrėžia ir paaiškina, ko egzaminuojamasis gali tikėtis egzamino metu',
                'category_id' => 2,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            ],
            [
                'title' => 'Pasiteirauja egzaminuojamojo ar pastarasis turi klausimų, sugeba atsakyti į egzaminuojamojo klausimus',
                'category_id' => 2,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            ],
            [
                'title' => 'Kalba aiškiai, glaustai apie su egzaminu susijusius dalykus (pasirenka egzaminuojamajam tinkamą turinį, stilių, kalbą ir kontekstą)',
                'category_id' => 2,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            ],
            //Elgesys egzamino metu
            [
                'title' => 'Sugeba atskirti teisingus / iš dalies teisingus / neteisingus atsakymus į patikrinimo prieš važiavimą klausimus',
                'category_id' => 3,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            ],
            [
                'title' => 'Tinkamai paaiškina, kaip reikia atlikti manevrus',
                'category_id' => 3,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            ],
            [
                'title' => 'Atidžiai stebi ir nuosekliai vertina egzaminuojamojo veiksmus',
                'category_id' => 3,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            ],
            [
                'title' => 'Atpažįsta potencialias problemas ir sugeba jas spręsti',
                'category_id' => 3,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            ],
            //Egzamino rezultato pateikimas
            [
                'title' => 'Pateikia aiškų ir konstruktyvų atsiliepimą apie egzamino rezultatus (pasirenka egzaminuojamajam tinkamą turinį, stilių, kalbą ir kontekstą) ',
                'category_id' => 4,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            ],
            [
                'title' => 'Pabrėžia teigiamus ir tik paskui neigiamus dalykus',
                'category_id' => 4,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            ],
            [
                'title' => 'Padeda formuoti tinkamą požiūrį į saugų vairavimą',
                'category_id' => 4,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            ],
            [
                'title' => 'Pateikia konkrečios egzaminuojamojo ir apskritai nesėkmės paaiškinimą',
                'category_id' => 4,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            ],
            [
                'title' => 'Paaiškina egzaminuojamajam, kokius vairavimo įgūdžius derėtų tobulinti',
                'category_id' => 4,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            ],
            [
                'title' => 'Paaiškina egzaminuojamajam, kaip galima gauti ataskaitos kopiją',
                'category_id' => 4,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            ],
            //Egzamino ataskaitos pildymas
            [
                'title' => 'Tinkamai akcentuoja teigiamus gebėjimus ir įgūdžius',
                'category_id' => 5,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            ],
            [
                'title' => 'Parenka tinkamus klaidų apibrėžimus',
                'category_id' => 5,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            ],
        ];
        Criterion::insert($criteria);
    }
}
