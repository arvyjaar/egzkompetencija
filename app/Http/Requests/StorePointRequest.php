<?php

namespace App\Http\Requests;

use App\Point;
use Illuminate\Foundation\Http\FormRequest;

class StorePointRequest extends FormRequest
{
    public function authorize()
    {
        return \Gate::allows('point_create');
    }

    public function rules()
    {
        return [
            'description' => [
                'required',
                'unique:points',
            ],
            'value'       => [
                'min:1',
                'max:1',
                'required',
                'unique:points',
            ],
        ];
    }
}
