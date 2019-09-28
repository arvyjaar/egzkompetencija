<?php

namespace App\Rules;

use App\Criterion;
use Illuminate\Contracts\Validation\Rule;

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
        $total_criteria = Criterion::all()->count();
        $sum = array_sum(array_map("count", $value));
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
