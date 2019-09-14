<?php

namespace App\Http\Controllers\Admin;

use App\Criterion;
use App\Evaluation;
use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyEvaluationRequest;
use App\Http\Requests\StoreEvaluationRequest;
use App\Http\Requests\UpdateEvaluationRequest;
use App\MonitoringReport;
use App\Point;

class EvaluationController extends Controller
{
    public function index()
    {
        abort_unless(\Gate::allows('evaluation_access'), 403);

        $evaluations = Evaluation::all();

        return view('admin.evaluations.index', compact('evaluations'));
    }

    public function create()
    {
        abort_unless(\Gate::allows('evaluation_create'), 403);

        $monitoringreports = MonitoringReport::all()->pluck('exam_date', 'id');

        $criterias = Criterion::all()->pluck('title', 'id');

        $points = Point::all()->pluck('description', 'id');

        return view('admin.evaluations.create', compact('monitoringreports', 'criterias', 'points'));
    }

    public function store(StoreEvaluationRequest $request)
    {
        abort_unless(\Gate::allows('evaluation_create'), 403);

        $evaluation = Evaluation::create($request->all());
        $evaluation->monitoringreports()->sync($request->input('monitoringreports', []));
        $evaluation->criterias()->sync($request->input('criterias', []));
        $evaluation->points()->sync($request->input('points', []));

        return redirect()->route('admin.evaluations.index');
    }

    public function edit(Evaluation $evaluation)
    {
        abort_unless(\Gate::allows('evaluation_edit'), 403);

        $monitoringreports = MonitoringReport::all()->pluck('exam_date', 'id');

        $criterias = Criterion::all()->pluck('title', 'id');

        $points = Point::all()->pluck('description', 'id');

        $evaluation->load('monitoringreports', 'criterias', 'points');

        return view('admin.evaluations.edit', compact('monitoringreports', 'criterias', 'points', 'evaluation'));
    }

    public function update(UpdateEvaluationRequest $request, Evaluation $evaluation)
    {
        abort_unless(\Gate::allows('evaluation_edit'), 403);

        $evaluation->update($request->all());
        $evaluation->monitoringreports()->sync($request->input('monitoringreports', []));
        $evaluation->criterias()->sync($request->input('criterias', []));
        $evaluation->points()->sync($request->input('points', []));

        return redirect()->route('admin.evaluations.index');
    }

    public function show(Evaluation $evaluation)
    {
        abort_unless(\Gate::allows('evaluation_show'), 403);

        $evaluation->load('monitoringreports', 'criterias', 'points');

        return view('admin.evaluations.show', compact('evaluation'));
    }

    public function destroy(Evaluation $evaluation)
    {
        abort_unless(\Gate::allows('evaluation_delete'), 403);

        $evaluation->delete();

        return back();
    }

    public function massDestroy(MassDestroyEvaluationRequest $request)
    {
        Evaluation::whereIn('id', request('ids'))->delete();

        return response(null, 204);
    }
}
