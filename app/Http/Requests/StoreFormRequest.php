<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreFormRequest extends FormRequest
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
            'version' => [
                'required',
            ],
            'active' => [
                'boolean',
            ],
            'competencies' => [
                'required'
            ]
        ];
    }
}
