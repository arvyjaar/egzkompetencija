<?php

namespace App\Http\Requests;

use App\Report;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreReportRequest extends FormRequest
{
    public function authorize()
    {
        return \Gate::allows('report_create');
    }

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

    public function messages()
    {
        return $messages = [
            'employee_id.required' => 'Nepasirinktas darbuotojas',
            'procedure_date.required' => 'Nepasirinkta procedūros data ir laikas',
            'observing_date.required' => 'Nepasirinkta stebėjimo data',
            'drivecategory_id.required' => 'Nepasirinkta TP kategorija',
            'observing_type.required' => 'Nepasirinkta Procedūra / Vaizdo įrašas',
            'point.required' => 'Ne visi kriterijai įvertinti balais',
        ];
    }
}
// ToDo: translate messages to language file
