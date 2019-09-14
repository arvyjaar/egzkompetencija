<?php

namespace App\Http\Requests;

use App\Criterion;
use Illuminate\Foundation\Http\FormRequest;

class UpdateCriterionRequest extends FormRequest
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
                'unique:criteria,title,' . request()->route('criterion')->id,
            ],
        ];
    }
}
