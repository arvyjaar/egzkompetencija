<?php

namespace App\Http\Controllers\Admin;

use App\Point;
use App\Rules\AllPoints;
use App\User;
use App\Branch;
use App\Category;
use Carbon\Carbon;
use App\Evaluation;
use App\Competency;
use App\MonitoringReport;
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
            $query->with(['examiner', 'observer']);

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
                return $row->observer_id ? $row->observer->name : '';
            });
            $table->editColumn('examiner', function ($row) {
                return $row->examiner_id ? $row->examiner->name : '';
            });
            //$table->editColumn('user.email', function ($row) {
            //    return $row->user_id ? (is_string($row->user) ? $row->user : $row->user->email) : '';
            //});
            $table->editColumn('branch', function ($row) {
                return $row->branch_id ? $row->branch->title : "";
            });

            $table->editColumn('drivecategory', function ($row) {
                return $row->drivecategory ? $row->drivecategory : "";
            });

            $table->editColumn('observing_type', function ($row) {
                return $row->observing_type ? MonitoringReport::OBSERVING_TYPE_RADIO[$row->observing_type] : '';
            });
            $table->editColumn('technical_note', function ($row) {
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
        $categories = Category::all();

        return view('admin.monitoringReports.create', compact('users', 'branches', 'points', 'categories'));
    }

    public function store(StoreMonitoringReportRequest $request)
    {
        abort_unless(\Gate::allows('monitoring_report_create'), 403);

        // validating quantity of submitted evaluations (custom validation rule - AllPoints)
        $request->validate([
            'point' => ['required', 'array', new AllPoints()],
        ]);

        // adding observer - logged in user
        $request->request->add(['observer_id' => Auth::user()->id]);
        $report = MonitoringReport::create($request->all());

        // preparing competencies array
        $competencies = [];
        foreach ($request->competency_note as $key => $value) {
            array_push($competencies,
                [
                    'monitoringreport_id' => $report->id,
                    'category_id' => $key,
                    'note' => $value,
                ]
            );
        }
        // inserting competencies...
        foreach ($competencies as $competency_model) {
            $competency = Competency::create($competency_model);

            // preparing evaluations array
            $evaluations = []; // must be defined outside the loop, to erase the value of previous iteration !
            foreach ($request->point as $category_id => $values) {
                if ($category_id == $competency->category_id) {
                    foreach ($values as $key => $value) {
                        array_push($evaluations, [
                            'competency_id' => $competency->id, // Inserted competency id
                            'criterion_id' => $key,
                            'point_id' => $value,
                        ]);
                    }
                }
            }
            // ...and inserting related evaluations
            isset($evaluations) ? $competency->evaluation()->createMany($evaluations) : false;
        }

        return redirect()->route('admin.monitoring-reports.index');
    }

    public function edit(MonitoringReport $monitoringReport)
    {
        abort_unless(\Gate::allows('monitoring_report_edit'), 403);

        $users = User::all()->pluck('name', 'id')->prepend('Pasirinkite', '');

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

        $points = Point::all();
        $monitoringReport->load(['examiner', 'observer', 'branch']);
        $competencies = Competency::where('monitoringreport_id', $monitoringReport->id)->get();
        $competencies->load(['evaluation', 'category']);

        return view('admin.monitoringReports.show', compact('points', 'monitoringReport', 'competencies'));
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
