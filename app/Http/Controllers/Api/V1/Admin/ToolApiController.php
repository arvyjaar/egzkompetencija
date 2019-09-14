<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreToolRequest;
use App\Http\Requests\UpdateToolRequest;
use App\Tool;

class ToolApiController extends Controller
{
    public function index()
    {
        $tools = Tool::all();

        return $tools;
    }

    public function store(StoreToolRequest $request)
    {
        return Tool::create($request->all());
    }

    public function update(UpdateToolRequest $request, Tool $tool)
    {
        return $tool->update($request->all());
    }

    public function show(Tool $tool)
    {
        return $tool;
    }

    public function destroy(Tool $tool)
    {
        $tool->delete();

        return response("OK", 200);
    }
}
