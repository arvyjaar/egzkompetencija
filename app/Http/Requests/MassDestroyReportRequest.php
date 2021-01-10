<?php

namespace App\Http\Requests;

use App\Report;
use Gate;
use Illuminate\Foundation\Http\FormRequest;

class MassDestroyReportRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('is_admin'), 403, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'ids'   => 'required|array',
            'ids.*' => 'exists:reports,id',
        ];
    }
}
