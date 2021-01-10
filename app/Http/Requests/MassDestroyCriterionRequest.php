<?php

namespace App\Http\Requests;

use App\Models\Criterion;
use Gate;
use Illuminate\Foundation\Http\FormRequest;

class MassDestroyCriterionRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('criterion_edit'), 403, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'ids'   => 'required|array',
            'ids.*' => 'exists:criteria,id',
        ];
    }
}
