<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Criterion;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreCriterionRequest;
use App\Http\Requests\UpdateCriterionRequest;

class CriteriaApiController extends Controller
{
    public function index()
    {
        $criteria = Criterion::all();

        return $criteria;
    }

    public function store(StoreCriterionRequest $request)
    {
        return Criterion::create($request->all());
    }

    public function update(UpdateCriterionRequest $request, Criterion $criterion)
    {
        return $criterion->update($request->all());
    }

    public function show(Criterion $criterion)
    {
        return $criterion;
    }

    public function destroy(Criterion $criterion)
    {
        $criterion->delete();

        return response("OK", 200);
    }
}
