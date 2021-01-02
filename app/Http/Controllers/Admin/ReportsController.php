<?php

namespace App\Http\Controllers\Admin;

use App\Models\CompetencyNote;
use App\Models\User;
use App\Models\Competency;
use App\Models\Evaluation;
use App\Models\Report;
use App\Rules\AllPoints;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Yajra\DataTables\Facades\DataTables;
use App\Http\Requests\StoreReportRequest;
use App\Http\Requests\UpdateReportRequest;
use App\Http\Requests\MassDestroyReportRequest;
use App\Models\AssessmentType;
use Illuminate\Support\Facades\DB;
use App\Models\Criterion;
use App\Models\Drivecategory;
use App\Models\Form;
use App\Models\ObservingType;

class ReportsController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $query = Report::query()->select('*');
            $query->with(['employee', 'observer']);

            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', 'Actions');

            $table->editColumn('actions', function ($row) {
                $viewGate = 'report_show';
                $editGate = 'report_edit_delete';
                $deleteGate = 'report_edit_delete';
                $crudRoutePart = 'reports';

                return view('partials.datatablesActions', compact(
                    'viewGate',
                    'editGate',
                    'deleteGate',
                    'crudRoutePart',
                    'row'
                ));
            });
            $table->editColumn('observer_id', function ($row) {
                return $row->observer_id ? $row->observer->name : '';
            });
            $table->editColumn('employee_id', function ($row) {
                return $row->employee_id ? $row->employee->name : '';
            });
            $table->editColumn('drivecategory_id', function ($row) {
                return $row->drivecategory ? $row->drivecategory : "";
            });

            $table->rawColumns(['actions', 'placeholder']);

            return $table->make(true);
        }

        return view('admin.reports.index');
    }

    public function create()
    {
        abort_unless(\Gate::allows('report_create'), 403);

        $form = Form::find(1); // ToDo: get id from request
        $competencies = $form->competency->load(['criterion']);
        $users = User::all()->pluck('name', 'id')->prepend('---', '');
        $drivecategories = Drivecategory::all();
        $observing_types = ObservingType::all();

        return view('admin.reports.create', compact(
            'users',
            'competencies',
            'drivecategories',
            'observing_types',
            'form'
        ));
    }

    public function store(StoreReportRequest $request)
    {
        abort_unless(\Gate::allows('report_create'), 403);

        // ToDo: validate if the Form is still active and all criteria belongs to this form

        // validating quantity of submitted evaluations (custom validation rule - AllPoints)
        $request->validate(['point' => [ new AllPoints($request->form_id)]]);

        // adding observer - logged in user
        $request->request->add(['observer_id' => Auth::user()->id]);

        $report = Report::create($request->all());

        // preparing evaluations array...
        $evaluations = [];
        foreach ($request->point as $criterion_id => $value) {
            array_push($evaluations, [
                'criterion_id' => $criterion_id,
                'assessment_type_id' => Criterion::find($criterion_id)->assessment_type_id,
                'assessment_value' => $value,
            ]);
        }
        // ...and inserting related evaluations
        $report->evaluation()->createMany($evaluations);

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
        isset($competency_notes) ? $report->competencyNote()->createMany($competency_notes) : false;

        return redirect()->route('admin.reports.index');
    }

    public function edit(Report $report)
    {
        abort_unless(\Gate::allows('report_create', $report), 403);

        $users = User::all()->pluck('name', 'id')->prepend('---', '');
        
        $drivecategories = Drivecategory::all();
        $observing_types = ObservingType::all();
        $evaluation_set = $report->evaluationSet();
       
        //dd($evaluation_set);
        return view('admin.reports.edit', compact(
            'report',
            'users',
            'drivecategories',
            'observing_types',
            'evaluation_set'
        ));
    }

    public function update(UpdateReportRequest $request, Report $report)
    {
        abort_unless(\Gate::allows('report_create', $report), 403);
        
        $report->update($request->except('form_id'));
        
        $comp_notes = $request->competency_note;
        foreach ($comp_notes as $comp_id => $note) {
            $comp_note = $report->competencyNote()->where('competency_id', (int)$comp_id)->first();
            if (!isset($comp_note) && $note != '') {
                $report->competencyNote()->create([
                    'competency_id' => (int)$comp_id,
                    'text' => $note,
                ]);
            } elseif (isset($comp_note) && $note != '') {
                $comp_note->update(['text' => $note]);
            } elseif (isset($comp_note) && $note == '') {
                $comp_note->delete();
            }
        }

        return redirect()->route('admin.reports.index');
    }

    public function updateSingleEvaluation(Request $request, Report $report)
    {
        if (\Gate::allows('report_edit_delete', $report)) {
            $evaluation = tap(Evaluation::find($request->evaluation_id))->update(['assessment_value' => $request->assessment_value]);

            return response()->json(['success' => 'Nauja reikšmė: '.strtoupper($evaluation->assessment_value)]);
        } else {
            return response()->json(['success' => 'Nepavyko išsaugoti!']);
        }
    }

    public function show(Report $report)
    {
        abort_unless(\Gate::allows('report_show', $report), 403);

        $evaluation_set = $report->evaluationSet();

        if (auth()->user()->id === $report->employee_id) {
            $report->update([
                'employee_reviewed_at' => Carbon::now()->format('Y-m-d H:i:s')
            ]);
        }

        return view('admin.reports.show', compact('report', 'evaluation_set'));
    }

    // Saving emplyee or manager notes to the monitoring report
    public function comment(Request $request, Report $report)
    {
        abort_unless(\Gate::allows('report_comment', $report), 403);
        // ToDo: restrict comment only to employee and manager
        if (auth()->user()->id === $report->employee_id) {
            $updated = tap($report)->update(['employee_note' => $request->comment]);
        } else {
            $updated = tap($report)->update(['manager_note' => $request->comment]);
        }

        $report = $updated;
        $evaluation_set = $report->evaluationSet();

        return view('admin.reports.show', compact('report', 'evaluation_set'));
    }

    public function destroy(Report $report)
    {
        abort_unless(\Gate::allows('report_edit_delete', $report), 403);

        $report->evaluation()->delete();
        $report->competencyNote()->delete();
        $report->delete();

        return back();
    }

    public function massDestroy(MassDestroyReportRequest $request)
    {
        abort_unless(\Gate::allows('is_admin'), 403);

        Report::whereIn('id', request('ids'))->delete();
        Evaluation::whereIn('report_id', request('ids'))->delete();
        CompetencyNote::whereIn('report_id', request('ids'))->delete();

        return response(null, 204);
    }
}
