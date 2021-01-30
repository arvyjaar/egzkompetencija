<?php

namespace App\Http\Controllers\Admin;

use App\Models\Competency;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreCompetencyRequest;
use App\Models\Worktype;

class CompetencyController extends Controller
{
    public function __construct()
    {
        $this->authorizeResource(Competency::class, 'competency');
    }
    
    public function index()
    {
        $competencies = Competency::with('criterion')->get();

        return view('admin.competencies.index', compact('competencies'));
    }

    public function create()
    {
        $worktypes = Worktype::pluck('title', 'id');

        return view('admin.competencies.create', compact('worktypes'));
    }

    public function store(StoreCompetencyRequest $request)
    {   
        $competency = Competency::create($request->all());

        return redirect()->route('admin.competencies.index');
    }

    public function edit(Competency $competency)
    {
        $worktypes = Worktype::pluck('title', 'id');
        
        return view('admin.competencies.edit', compact('competency', 'worktypes'));
    }

    public function update(StoreCompetencyRequest $request, Competency $competency)
    {
        $competency->update($request->all());

        return redirect()->route('admin.competencies.index');
    }

    public function show(Competency $competency)
    {
        return view('admin.competencies.show', compact('competency'));
    }

    public function destroy(Competency $competency)
    {
        $competency->delete();

        return back();
    }
}
