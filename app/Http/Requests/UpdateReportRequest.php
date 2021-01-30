<?php

namespace App\Http\Requests;

use App\Models\Report;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateReportRequest extends FormRequest
{
    public function rules()
    {
        return [
            'employee_id' => [
                'required',
                'numeric',
            ],
            'procedure_date' => [
                'required',
                'date_format:' . config('panel.date_format') . ' ' . config('panel.time_format'),
            ],
            'drivecategory_id' => [
                'min:1',
                'max:3',
                'required',
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
