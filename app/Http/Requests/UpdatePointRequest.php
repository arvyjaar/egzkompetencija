<?php

namespace App\Http\Requests;

use App\Point;
use Illuminate\Foundation\Http\FormRequest;

class UpdatePointRequest extends FormRequest
{
    public function authorize()
    {
        return \Gate::allows('point_edit');
    }

    public function rules()
    {
        return [
            'description' => [
                'required',
                'unique:points,description,' . request()->route('point')->id,
            ],
            'value'       => [
                'min:1',
                'max:1',
                'required',
                'unique:points,value,' . request()->route('point')->id,
            ],
        ];
    }
}
