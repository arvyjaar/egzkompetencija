<?php

namespace App\Http\Controllers\Admin;

use App\Models\Form;
use App\Models\Worktype;
use Illuminate\Http\Request;
use App\Models\Competency;
use App\Http\Controllers\Controller;
use App\Models\Evaluation;
use App\Http\Requests\StoreFormRequest;

class FormsController extends Controller
{
    public function index()
    {
        abort_unless(\Gate::allows('criterion_access'), 403);

        $forms = Form::with('competency')->get();
        
        return view('admin.forms.index', compact('forms'));
    }

    public function create()
    {
        abort_unless(\Gate::allows('criterion_edit'), 403);

        $worktypes = Worktype::pluck('title', 'id');
        $competencies = Competency::whereHas('criterion')->get();

        return view('admin.forms.create', compact('worktypes', 'competencies'));
    }

    public function store(StoreFormRequest $request)
    {
        abort_unless(\Gate::allows('criterion_edit'), 403);

        // If form checked as active, deactivate all other forms of this work type
        if (! $request->boolean('active')) {
            $request->merge(['active' => 0 ]);
        } else {
            Form::where('worktype_id', $request->worktype_id)->update(['active' => 0]);
        };

        $form = Form::create($request->all());
        $form->competency()->sync($request->input('competencies', []));

        return redirect()->route('admin.forms.index');
    }

    public function show(Form $form)
    {
        abort_unless(\Gate::allows('criterion_access'), 403);

        return view('admin.forms.show', compact('form'));
    }

    public function edit(Form $form)
    {
        abort_unless(\Gate::allows('criterion_edit'), 403);

        $worktypes = Worktype::pluck('title', 'id');
        $competencies = Competency::whereHas('criterion')->get();
        $form->load('competency');

        return view('admin.forms.edit', compact('worktypes', 'form', 'competencies'));
    }

    public function update(StoreFormRequest $request, Form $form)
    {
        abort_unless(\Gate::allows('criterion_edit'), 403);

        // If form checked as active, deactivate all other forms of this work type
        if (! $request->boolean('active')) {
            $request->merge(['active' => 0 ]);
        } else {
            Form::where('worktype_id', $request->worktype_id)->update(['active' => 0]);
        };
        $form->update($request->all());
        $form->competency()->sync($request->input('competencies', []));
        
        return redirect()->route('admin.forms.index');
    }

    public function destroy(Form $form)
    {
        abort_unless(\Gate::allows('criterion_edit'), 403);

        $evaluations = Evaluation::where('form_id', $form)->get();
        if ($evaluations->count() > 0) {
            return back()->withErrors(['form' => 'Form has evaluations']);
        } else {
            $form->delete();

            return back();
        }
    }
}
