<?php

namespace App\Http\Requests;

use App\MonitoringReport;
use Illuminate\Foundation\Http\FormRequest;

class StoreMonitoringReportRequest extends FormRequest
{
    public function authorize()
    {
        return \Gate::allows('monitoring_report_create');
    }

    public function rules()
    {
        return [
            'examiner_id'           => [
                'required',
                'integer',
            ],
            'branch_id'            => [
                'integer',
                'required',
            ],
            'exam_date'         => [
                'required',
                'date_format:' . config('panel.date_format') . ' ' . config('panel.time_format'),
            ],
            'drivecategory'          => [
                'min:1',
                'max:3',
                'required',
            ],
            'observing_date'    => [
                'required',
                'date_format:' . config('panel.date_format'),
            ],
            'observing_type'    => [
                'required',
            ],
            'examiner_reviewed' => [
                'date_format:' . config('panel.date_format') . ' ' . config('panel.time_format'),
                'nullable',
            ],
        ];
    }

    public function messages()
    {
        return $messages = [
            'examiner_id.required' => 'Nepasirnktas egzaminuotojas',
            'branch_id' => 'Nepasirinktas filialas/grupė',
            'exam_date' => 'Nepasirinkta egzamino data ir laikas',
            'observing_date' => 'Nepasirinkta stebėjimo data',
            'drivecategory' => 'Nepasirinkta TP kategorija',
            'observing_type' => 'Nepasirinktas Egzaminas / Vaizdo įrašas',
            'point.required' => 'Ne visi darbo aspektai įvertinti balais',
        ];
    }
}
