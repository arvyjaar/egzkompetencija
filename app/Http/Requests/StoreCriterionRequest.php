<?php

namespace App\Http\Requests;

use App\Models\Criterion;
use Illuminate\Foundation\Http\FormRequest;

class StoreCriterionRequest extends FormRequest
{
    public function authorize()
    {
        return \Gate::allows('criterion_create');
    }

    public function rules()
    {
        return [
            'title' => [
                'required',
            ],
            'competency_id' => [
                'required',
                'integer',
            ],
            'assessment_type_id' => [
                'required',
                'integer',
            ]
        ];
    }

    public function messages()
    {
        return $messages = [
            'title.required' => 'Pavadinimas privalomas',
            'competency_id.required' => 'Kompetencija privaloma',
            'assessment_type_id' => 'Vertinimo skalė privaloma'
        ];
    }
}
