<?php

namespace App\Rules;

use App\Models\Form;
use Illuminate\Contracts\Validation\Rule;

class AllPoints implements Rule
{
    private $form_id;
    
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct($form_id)
    {
        $this->form_id = $form_id;
    }

    /**
     * Determine if the validation rule passes.
     * Should be checked points for all criteria of each competency
     *
     * @param  string  $attribute attribute name
     * @param  mixed  $value points array
     * @return bool
     */
    public function passes($attribute, $value)
    {
        // Count criteria only included in submited Form (report)
        $form = Form::find($this->form_id);
        $competencies = $form->competency->load(['criterion']);
        $total_criteria = 0;
        foreach ($competencies as $competency) {
            $total_criteria += $competency->criterion->count();
        };
        
        $submited_points = count($value);
        // for error text in message()
        $this->total_criteria = $total_criteria; 
        $this->submited_points = $submited_points;

        return $submited_points === $total_criteria;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'Ne visi, o tik '.$this->submited_points.' iš '.$this->total_criteria.' šios formos kriterijų įvertinti.';
    }
}
