<?php

namespace App\Http\Requests;

use App\Tool;
use Illuminate\Foundation\Http\FormRequest;

class StoreToolRequest extends FormRequest
{
    public function authorize()
    {
        return \Gate::allows('tool_create');
    }

    public function rules()
    {
        return [
            'title'     => [
                'required',
            ],
            'condition' => [
                'required',
            ],
            'branch'    => [
                'min:2',
                'max:3',
                'required',
            ],
        ];
    }
}
