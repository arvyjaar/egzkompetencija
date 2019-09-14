<?php

namespace App\Http\Requests;

use App\Evaluation;
use Illuminate\Foundation\Http\FormRequest;

class StoreEvaluationRequest extends FormRequest
{
    public function authorize()
    {
        return \Gate::allows('evaluation_create');
    }

    public function rules()
    {
        return [
            'monitoringreports.*' => [
                'integer',
            ],
            'monitoringreports'   => [
                'required',
                'array',
            ],
            'criterias.*'         => [
                'integer',
            ],
            'criterias'           => [
                'required',
                'array',
            ],
            'points.*'            => [
                'integer',
            ],
            'points'              => [
                'required',
                'array',
            ],
        ];
    }
}
