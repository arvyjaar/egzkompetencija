<?php

namespace App\Http\Requests;

use App\Point;
use Gate;
use Illuminate\Foundation\Http\FormRequest;

class MassDestroyPointRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('point_delete'), 403, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'ids'   => 'required|array',
            'ids.*' => 'exists:points,id',
        ];
    }
}
