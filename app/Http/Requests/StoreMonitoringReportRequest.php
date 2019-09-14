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
            'observer'          => [
                'required',
            ],
            'user_id'           => [
                'required',
                'integer',
            ],
            'branch'            => [
                'min:2',
                'max:2',
                'required',
            ],
            'exam_date'         => [
                'required',
                'date_format:' . config('panel.date_format') . ' ' . config('panel.time_format'),
            ],
            'category'          => [
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
}
