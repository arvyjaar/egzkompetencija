<?php

namespace App\Rules;

use App\Models\Criterion;
use App\Models\Form;
use Illuminate\Contracts\Validation\Rule;
use Illuminate\Support\Facades\DB;

class AllPoints implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Determine if the validation rule passes.
     * Should be checked points for all criteria of each competency
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        // Count criteria only included in submited Form (report)
        $form = Form::find($value->form_id);
        $competencies = $form->competency->load(['criterion']);
        $total_criteria = 0;
        foreach ($competencies as $competency) {
            $total_criteria += $competency->criterion->count();
        };
        $sum = count($value->point);
        return $sum >= $total_criteria;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'Ne visi darbo aspektai įvertinti.';
    }
}
