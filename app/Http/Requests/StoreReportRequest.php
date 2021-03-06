<?php

namespace App\Http\Requests;

use App\Report;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreReportRequest extends FormRequest
{
    public function rules()
    {
        return [
            'form_id' => [
                'required',
                'numeric'
            ],
            'employee_id' => [
                'required',
                'numeric',
            ],
            'procedure_date' => [
                'required',
                'date_format:' . config('panel.date_format') . ' ' . config('panel.time_format'),
            ],
            'drivecategory_id' => [
                'nullable',
                'numeric',
            ],
            'observing_date' => [
                'required',
                'date_format:' . config('panel.date_format'),
            ],
            'observing_type_id' => [
                'required',
                'numeric',
            ],
            'employee_reviewed_at' => [
                'date_format:' . config('panel.date_format') . ' ' . config('panel.time_format'),
                'nullable',
            ],
        ];
    }
}
