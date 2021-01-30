<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreCompetencyRequest extends FormRequest
{
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
}
