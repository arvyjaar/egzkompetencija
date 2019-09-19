<?php

namespace App\Http\Controllers\Admin;

use App\Point;
use App\User;
use App\Branch;
use App\Critcategory;
use App\MonitoringReport;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Yajra\DataTables\Facades\DataTables;
use App\Http\Requests\StoreMonitoringReportRequest;
use App\Http\Requests\UpdateMonitoringReportRequest;
use App\Http\Requests\MassDestroyMonitoringReportRequest;


class MonitoringReportController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $query = MonitoringReport::query()->select('*');
            $query->with(['user']);
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate = 'monitoring_report_show';
                $editGate = 'monitoring_report_edit';
                $deleteGate = 'monitoring_report_delete';
                $crudRoutePart = 'monitoring-reports';

                return view('partials.datatablesActions', compact(
                    'viewGate',
                    'editGate',
                    'deleteGate',
                    'crudRoutePart',
                    'row'
                ));
            });
            $table->editColumn('observer', function ($row) {
                return $row->observer ? $row->observer : "";
            });
            $table->editColumn('user.user', function ($row) {
                return $row->user_id ? (is_string($row->user) ? $row->user : $row->user->name) : '';
            });
            $table->editColumn('user.email', function ($row) {
                return $row->user_id ? (is_string($row->user) ? $row->user : $row->user->email) : '';
            });
            $table->editColumn('branch', function ($row) {
                return $row->branch ? $row->branch : "";
            });

            $table->editColumn('category', function ($row) {
                return $row->category ? $row->category : "";
            });

            $table->editColumn('observing_type', function ($row) {
                return $row->observing_type ? MonitoringReport::OBSERVING_TYPE_RADIO[$row->observing_type] : '';
            });
            $table->editColumn('technical_notes', function ($row) {
                return $row->technical_notes ? $row->technical_notes : "";
            });

            $table->rawColumns(['actions', 'placeholder', 'user']);

            return $table->make(true);
        }

        return view('admin.monitoringReports.index');
    }

    public function create()
    {
        abort_unless(\Gate::allows('monitoring_report_create'), 403);

        $users = User::all()->pluck('name', 'id')->prepend('Pasirinkite', '');
        $branches = Branch::all()->pluck('title', 'id')->prepend('Pasirinkite', '');
        $points = Point::all();
        $critcategories = Critcategory::all();

        return view('admin.monitoringReports.create', compact('users', 'branches', 'points', 'critcategories'));
    }

    public function store(StoreMonitoringReportRequest $request)
    {
        abort_unless(\Gate::allows('monitoring_report_create'), 403);

        $request->request->add(['observer_id' => Auth::user()->id]);
        $report = MonitoringReport::create($request->all());
        $evaluation = [];
        foreach ($request->point as $key => $value) {
            array_push($evaluation, [
                'monitoringreport_id' => $report->id, // Inserted report id
                'criterion_id' => $key,
                'point_id' => $value,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            ]);
        }
        DB::table('monitoringreport_criterion_point_pivot')->insert($evaluation);

        return redirect()->route('admin.monitoring-reports.index');
    }

    public function edit(MonitoringReport $monitoringReport)
    {
        abort_unless(\Gate::allows('monitoring_report_edit'), 403);

        $users = User::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $monitoringReport->load('user');

        return view('admin.monitoringReports.edit', compact('users', 'monitoringReport'));
    }

    public function update(UpdateMonitoringReportRequest $request, MonitoringReport $monitoringReport)
    {
        abort_unless(\Gate::allows('monitoring_report_edit'), 403);

        $monitoringReport->update($request->all());

        return redirect()->route('admin.monitoring-reports.index');
    }

    public function show(MonitoringReport $monitoringReport)
    {
        abort_unless(\Gate::allows('monitoring_report_show'), 403);

        $monitoringReport->load('user');

        return view('admin.monitoringReports.show', compact('monitoringReport'));
    }

    public function destroy(MonitoringReport $monitoringReport)
    {
        abort_unless(\Gate::allows('monitoring_report_delete'), 403);

        $monitoringReport->delete();

        return back();
    }

    public function massDestroy(MassDestroyMonitoringReportRequest $request)
    {
        MonitoringReport::whereIn('id', request('ids'))->delete();

        return response(null, 204);
    }
}
