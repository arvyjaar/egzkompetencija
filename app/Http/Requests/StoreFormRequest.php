<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreFormRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return \Gate::allows('criterion_edit');
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
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
