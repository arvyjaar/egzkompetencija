<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyToolRequest;
use App\Http\Requests\StoreToolRequest;
use App\Http\Requests\UpdateToolRequest;
use App\Tool;

class ToolController extends Controller
{
    public function index()
    {
        abort_unless(\Gate::allows('tool_access'), 403);

        $tools = Tool::all();

        return view('admin.tools.index', compact('tools'));
    }

    public function create()
    {
        abort_unless(\Gate::allows('tool_create'), 403);

        return view('admin.tools.create');
    }

    public function store(StoreToolRequest $request)
    {
        abort_unless(\Gate::allows('tool_create'), 403);

        $tool = Tool::create($request->all());

        return redirect()->route('admin.tools.index');
    }

    public function edit(Tool $tool)
    {
        abort_unless(\Gate::allows('tool_edit'), 403);

        return view('admin.tools.edit', compact('tool'));
    }

    public function update(UpdateToolRequest $request, Tool $tool)
    {
        abort_unless(\Gate::allows('tool_edit'), 403);

        $tool->update($request->all());

        return redirect()->route('admin.tools.index');
    }

    public function show(Tool $tool)
    {
        abort_unless(\Gate::allows('tool_show'), 403);

        return view('admin.tools.show', compact('tool'));
    }

    public function destroy(Tool $tool)
    {
        abort_unless(\Gate::allows('tool_delete'), 403);

        $tool->delete();

        return back();
    }

    public function massDestroy(MassDestroyToolRequest $request)
    {
        Tool::whereIn('id', request('ids'))->delete();

        return response(null, 204);
    }
}
