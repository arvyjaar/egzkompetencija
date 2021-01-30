<?php

namespace App\Http\Controllers\Admin;

use App\Models\Criterion;
use App\Models\Competency;
use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyCriterionRequest;
use App\Http\Requests\StoreCriterionRequest;
use App\Models\AssessmentType;

class CriterionController extends Controller
{
    public function __construct()
    {
        $this->authorizeResource(Criterion::class, 'criterion');
    }
    
    public function index()
    {
        $criteria = Criterion::all();

        return view('admin.criteria.index', compact('criteria'));
    }

    public function create()
    {
        $competencies = Competency::all();
        $assessment_types = AssessmentType::all();

        return view('admin.criteria.create', compact('competencies', 'assessment_types'));
    }

    public function store(StoreCriterionRequest $request)
    {
        $criterion = Criterion::create($request->all());

        return redirect()->route('admin.criteria.index');
    }

    public function edit(Criterion $criterion)
    {
        $competencies = Competency::all();
        $assessment_types = AssessmentType::all();
        return view('admin.criteria.edit', compact('criterion', 'competencies', 'assessment_types'));
    }

    public function update(StoreCriterionRequest $request, Criterion $criterion)
    {
        $criterion->update($request->all());

        return redirect()->route('admin.criteria.index');
    }

    public function show(Criterion $criterion)
    {
        return view('admin.criteria.show', compact('criterion'));
    }

    public function destroy(Criterion $criterion)
    {
        $criterion->delete();

        return back();
    }
}
