<?php

namespace App\Http\Controllers\Admin;

use App\Models\Competency;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreCompetencyRequest;
use App\Models\Worktype;

class CompetencyController extends Controller
{
    public function index()
    {
        abort_unless(\Gate::allows('criterion_access'), 403);

        $competencies = Competency::with('criterion')->get();

        return view('admin.competencies.index', compact('competencies'));
    }

    public function create()
    {
        abort_unless(\Gate::allows('criterion_edit'), 403);

        $worktypes = Worktype::pluck('title', 'id');

        return view('admin.competencies.create', compact('worktypes'));
    }

    public function store(StoreCompetencyRequest $request)
    {
        abort_unless(\Gate::allows('criterion_edit'), 403);
        
        $competency = Competency::create($request->all());

        return redirect()->route('admin.competencies.index');
    }

    public function edit(Competency $competency)
    {
        abort_unless(\Gate::allows('criterion_edit'), 403);

        $worktypes = Worktype::pluck('title', 'id');

        
        return view('admin.competencies.edit', compact('competency', 'worktypes'));
    }

    public function update(StoreCompetencyRequest $request, Competency $competency)
    {
        abort_unless(\Gate::allows('criterion_edit'), 403);

        $competency->update($request->all());

        return redirect()->route('admin.competencies.index');
    }

    public function show(Competency $competency)
    {
        abort_unless(\Gate::allows('criterion_access'), 403);

        return view('admin.competencies.show', compact('competency'));
    }

    public function destroy(Competency $competency)
    {
        abort_unless(\Gate::allows('criterion_edit'), 403);

        $competency->delete();

        return back();
    }

    public function massDestroy(MassDestroyCompetencyRequest $request)
    {
        abort_unless(\Gate::allows('criterion_edit'), 403);

        Competency::whereIn('id', request('ids'))->delete();

        return response(null, 204);
    }
}
