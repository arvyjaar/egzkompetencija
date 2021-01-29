<?php

namespace Database\Factories;

use App\Models\Competency;
use App\Models\Report;
use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Criterion;
use App\Models\User;
use Faker\Factory as Faker;

class ReportFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Report::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $user_count = User::count();
        gc_collect_cycles(); // clean memory

        return [
            'form_id' => 1,
            'employee_id' => rand(1, $user_count),
            'observer_id' => rand(1, 10),
            'drivecategory_id' => rand(1, 11),
            'procedure_date' => $this->faker->dateTimeBetween('2020-01-01 12:00:00'),
            'observing_date' => $this->faker->dateTimeBetween('2020-01-01 12:00:00'),
            'observing_type_id' => rand(1, 2),
            'observer_note' => $this->faker->realText(),
            'employee_note' => $this->faker->realText(),
            'technical_note' => $this->faker->optional()->realText(),
            'manager_note' => $this->faker->optional()->realText(),
            'employee_reviewed_at' => $this->faker->optional()->dateTimeThisMonth(),
            //
        ];
    }

    public function configure()
    {
        return $this->afterMaking(function (Report $report) {
            //
        })->afterCreating(function (Report $report) {
            // preparing evaluations array...
            $criterion_count = Criterion::count();
            $competency_count = Competency::count();

            $evaluations = [];
            //foreach criterion as $id 
            foreach (range(1, $criterion_count) as $id) {
                array_push($evaluations, [
                'criterion_id' => $id,
                'assessment_type_id' => Criterion::find($id)->assessment_type_id,
                'assessment_value' => rand(1, 5), // ToDo: there are hardcoded values
                ]);
            };
            // ...and inserting related evaluations
            $report->evaluation()->createMany($evaluations);

            // preparing competency notes array
            $competency_notes = [];
            foreach (range(1, $competency_count) as $id) {
                array_push($competency_notes, [
                'competency_id' => $id,
                'text' => $this->faker->text(),
                ]);
            };
            // ...and inserting related competency notes
            isset($competency_notes) ? $report->competencyNote()->createMany($competency_notes) : false;
        });
    }
}
