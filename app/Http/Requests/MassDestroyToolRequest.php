<?php

namespace App\Http\Requests;

use App\Tool;
use Gate;
use Illuminate\Foundation\Http\FormRequest;

class MassDestroyToolRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('tool_delete'), 403, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'ids'   => 'required|array',
            'ids.*' => 'exists:tools,id',
        ];
    }
}
