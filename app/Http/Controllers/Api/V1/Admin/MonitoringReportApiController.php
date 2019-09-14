<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreMonitoringReportRequest;
use App\Http\Requests\UpdateMonitoringReportRequest;
use App\MonitoringReport;

class MonitoringReportApiController extends Controller
{
    public function index()
    {
        $monitoringReports = MonitoringReport::all();

        return $monitoringReports;
    }

    public function store(StoreMonitoringReportRequest $request)
    {
        return MonitoringReport::create($request->all());
    }

    public function update(UpdateMonitoringReportRequest $request, MonitoringReport $monitoringReport)
    {
        return $monitoringReport->update($request->all());
    }

    public function show(MonitoringReport $monitoringReport)
    {
        return $monitoringReport;
    }

    public function destroy(MonitoringReport $monitoringReport)
    {
        $monitoringReport->delete();

        return response("OK", 200);
    }
}
