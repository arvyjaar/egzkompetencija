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
                'unique:criteria',
            ],
            'critcategory_id' => [
                'required'
            ]
        ];
    }
}
