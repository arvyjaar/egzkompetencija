<?php

namespace App\Http\Requests;

use App\Models\Criterion;
use Illuminate\Foundation\Http\FormRequest;

class StoreCriterionRequest extends FormRequest
{
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
}
