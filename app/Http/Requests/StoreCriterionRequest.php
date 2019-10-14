<?php

namespace App\Http\Requests;

use App\Criterion;
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
                'required'
            ]
        ];
    }

    public function messages()
    {
        return $messages = [
            'title.required' => 'Pavadinimas privalomas',
            'competency_id.required' => 'Kompetencija privaloma',
        ];
    }
}
