<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreCompetencyRequest extends FormRequest
{
    public function authorize()
    {
        return \Gate::allows('criterion_edit');
    }

    public function rules()
    {
        return [
            'title' => [
                'required',
            ],
            'worktype_id' => [
                'required',
                'integer',
            ],
        ];
    }

    public function messages()
    {
        return $messages = [
            'title.required' => 'Pavadinimas privalomas',
            'worktype_id.required' => 'Veikla privaloma',
        ];
    }
}
