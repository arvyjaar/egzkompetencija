<?php

namespace App\Http\Requests;

use App\Tool;
use Illuminate\Foundation\Http\FormRequest;

class UpdateToolRequest extends FormRequest
{
    public function authorize()
    {
        return \Gate::allows('tool_edit');
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
