<?php

namespace App\Http\Controllers\Admin;

use App\Models\Form;
use App\Models\Worktype;
use Illuminate\Http\Request;
use App\Models\Competency;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreFormRequest;
use App\Models\Report;

class FormController extends Controller
{
    public function __construct()
    {
        $this->authorizeResource(Form::class, 'form');
    }
    
    public function index()
    {
        $forms = Form::with('competency')->get();
        
        return view('admin.forms.index', compact('forms'));
    }

    public function create()
    {
        $worktypes = Worktype::pluck('title', 'id');
        $competencies = Competency::whereHas('criterion')->get();

        return view('admin.forms.create', compact('worktypes', 'competencies'));
    }

    public function store(StoreFormRequest $request)
    {
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
        return view('admin.forms.show', compact('form'));
    }

    public function edit(Form $form)
    {
        $worktypes = Worktype::pluck('title', 'id');
        $competencies = Competency::whereHas('criterion')->get();
        $form->load('competency');

        return view('admin.forms.edit', compact('worktypes', 'form', 'competencies'));
    }

    public function update(StoreFormRequest $request, Form $form)
    {
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
        // check reports, just in case
        $reports = Report::where('form_id', $form)->get();
        if ($reports->count() > 0) {
            return back()->withErrors(['form' => 'Form has reports. You can not delete it']);
        } else {
            $form->delete();

            return back();
        }
    }
}
