<?php

namespace App\Http\Controllers\Admin;

use App\CompetencyNote;
use App\Point;
use App\Rules\AllPoints;
use App\User;
use App\Branch;
use App\Competency;
use App\Evaluation;
use App\MonitoringReport;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
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
            $query->with(['examiner', 'observer', 'branch']);

            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate = 'report_show';
                $editGate = 'report_edit_delete';
                $deleteGate = 'report_edit_delete';
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
        $competencies = Competency::all();
        $competencies->load(['criterion']);

        return view('admin.monitoringReports.create', compact('users', 'branches', 'points', 'competencies'));
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

        $monitoringReport = MonitoringReport::create($request->all());

        // preparing evaluations array...
        $evaluations = [];
        foreach ($request->point as $criterion_id => $value) {
            array_push($evaluations, [
                    'criterion_id' => $criterion_id,
                    'point_id' => $value,
            ]);
        }
        // ...and inserting related evaluations
        $monitoringReport->evaluation()->createMany($evaluations);

        // preparing competency notes array
        $competency_notes = [];
        foreach ($request->competency_note as $competency_id => $text) {
            if (trim($text) !== '') {
                array_push($competency_notes, [
                    'competency_id' => $competency_id,
                    'text' => $text,
                ]);
            }
        }
        // ...and inserting related competency notes
        isset($competency_notes) ? $monitoringReport->competencyNote()->createMany($competency_notes) : false;


        return redirect()->route('admin.monitoring-reports.index');
    }

    public function edit(MonitoringReport $monitoringReport)
    {
        abort_unless(\Gate::allows('report_edit_delete', $monitoringReport), 403);

        $users = User::all()->pluck('name', 'id')->prepend('Pasirinkite', '');
        $branches = Branch::all()->pluck('title', 'id')->prepend('Pasirinkite', '');
        $points = Point::all();
        $results = $monitoringReport->setResults();

        return view('admin.monitoringReports.edit', compact('users', 'monitoringReport', 'branches', 'points', 'results'));
    }

    public function update(StoreMonitoringReportRequest $request, MonitoringReport $monitoringReport)
    {
        abort_unless(\Gate::allows('report_edit_delete', $monitoringReport), 403);

        $monitoringReport->update($request->all());
        $comp_notes = $request->competency_note;

        foreach ($comp_notes as $comp_id => $note) {
            $comp_note = $monitoringReport->competencyNote()->where('competency_id', $comp_id)->first();
            if (! isset($comp_note) && $note != '') {
                $monitoringReport->competencyNote()->create([
                    'competency_id' => $comp_id,
                    'text' => $note,
                ]);
            } elseif (isset($comp_note) && $note != '') {
                $comp_note->update(['text' => $note]);
            } elseif (isset($comp_note) && $note == '') {
                $comp_note->delete();
            }
        }

        return redirect()->route('admin.monitoring-reports.index');
    }

    public function updateSingleEvaluation(Request $request, MonitoringReport $monitoringReport)
    {
        if (\Gate::allows('report_edit_delete', $monitoringReport)) {
        $eval = tap(Evaluation::find($request->eval_id))->update(['point_id' => $request->point_id]);
        $eval->load(['point']); // this is necessary to get updated model with new relation

        return response()->json(['success'=>$eval->point->title]);
        }
        else
            return response()->json(['success'=>'Nepavyko išsaugoti!']);
    }

    public function show(MonitoringReport $monitoringReport)
    {
        abort_unless(\Gate::allows('report_show', $monitoringReport), 403);

        $points = Point::all();
        $results = $monitoringReport->setResults();

        if (auth()->user()->id === $monitoringReport->examiner_id) {
            $monitoringReport->update([
                'examiner_reviewed' => Carbon::now()->format('Y-m-d H:i:s')
            ]);
        }

        return view('admin.monitoringReports.show', compact('points', 'monitoringReport', 'results'));
    }

    // Saving examiner or EVPIS notes to the monitoring report
    public function comment(Request $request, MonitoringReport $monitoringReport)
    {
        abort_unless(\Gate::allows('report_comment', $monitoringReport), 403);

        if (auth()->user()->id === $monitoringReport->examiner_id) {
            $updated = tap($monitoringReport)->update(['examiner_note' => $request->comment]);
        } else {
            $updated = tap($monitoringReport)->update(['evpis_note' => $request->comment]);
        }

        $monitoringReport = $updated;
        $points = Point::all();
        $results = $monitoringReport->setResults();

        return view('admin.monitoringReports.show', compact('points', 'monitoringReport', 'results'));
    }

    public function destroy(MonitoringReport $monitoringReport)
    {
        abort_unless(\Gate::allows('report_edit_delete', $monitoringReport), 403);

        $monitoringReport->evaluation()->delete();
        $monitoringReport->competencyNote()->delete();
        $monitoringReport->delete();

        return back();
    }

    public function massDestroy(MassDestroyMonitoringReportRequest $request)
    {
        abort_unless(\Gate::allows('is_admin'), 403);

        MonitoringReport::whereIn('id', request('ids'))->delete();
        Evaluation::whereIn('monitoringreport_id', request('ids'))->delete();
        CompetencyNote::whereIn('monitoringreport_id', request('ids'))->delete();

        return response(null, 204);
    }
}
