<?php

namespace App\Http\Requests;

use App\MonitoringReport;
use Gate;
use Illuminate\Foundation\Http\FormRequest;

class MassDestroyMonitoringReportRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('monitoring_report_delete'), 403, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'ids'   => 'required|array',
            'ids.*' => 'exists:monitoring_reports,id',
        ];
    }
}
