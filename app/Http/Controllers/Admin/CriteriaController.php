<?php

namespace App\Http\Controllers\Admin;

use App\Criterion;
use App\Competency;
use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyCriterionRequest;
use App\Http\Requests\StoreCriterionRequest;
use App\Http\Requests\UpdateCriterionRequest;

class CriteriaController extends Controller
{
    public function index()
    {
        abort_unless(\Gate::allows('is_admin'), 403);

        $criteria = Criterion::all();

        return view('admin.criteria.index', compact('criteria'));
    }

    public function create()
    {
        abort_unless(\Gate::allows('is_admin'), 403);

        $competencies = Competency::all()->pluck('title', 'id');
        return view('admin.criteria.create', compact('competencies'));
    }

    public function store(StoreCriterionRequest $request)
    {
        abort_unless(\Gate::allows('is_admin'), 403);
        $criterion = Criterion::create($request->all());

        return redirect()->route('admin.criteria.index');
    }

    public function edit(Criterion $criterion)
    {
        abort_unless(\Gate::allows('criterion_edit'), 403);

        $competencies = Competency::all()->pluck('title', 'id');
        return view('admin.criteria.edit', compact('criterion', 'competencies'));
    }

    public function update(StoreCriterionRequest $request, Criterion $criterion)
    {
        abort_unless(\Gate::allows('criterion_edit'), 403);

        $criterion->update($request->all());

        return redirect()->route('admin.criteria.index');
    }

    public function show(Criterion $criterion)
    {
        abort_unless(\Gate::allows('criterion_show'), 403);

        return view('admin.criteria.show', compact('criterion'));
    }

    public function destroy(Criterion $criterion)
    {
        abort_unless(\Gate::allows('criterion_delete'), 403);

        $criterion->delete();

        return back();
    }

    public function massDestroy(MassDestroyCriterionRequest $request)
    {
        Criterion::whereIn('id', request('ids'))->delete();

        return response(null, 204);
    }
}
