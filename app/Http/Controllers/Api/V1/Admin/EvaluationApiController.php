<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Evaluation;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreEvaluationRequest;
use App\Http\Requests\UpdateEvaluationRequest;

class EvaluationApiController extends Controller
{
    public function index()
    {
        $evaluations = Evaluation::all();

        return $evaluations;
    }

    public function store(StoreEvaluationRequest $request)
    {
        return Evaluation::create($request->all());
    }

    public function update(UpdateEvaluationRequest $request, Evaluation $evaluation)
    {
        return $evaluation->update($request->all());
    }

    public function show(Evaluation $evaluation)
    {
        return $evaluation;
    }

    public function destroy(Evaluation $evaluation)
    {
        $evaluation->delete();

        return response("OK", 200);
    }
}
