<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StorePointRequest;
use App\Http\Requests\UpdatePointRequest;
use App\Point;

class PointApiController extends Controller
{
    public function index()
    {
        $points = Point::all();

        return $points;
    }

    public function store(StorePointRequest $request)
    {
        return Point::create($request->all());
    }

    public function update(UpdatePointRequest $request, Point $point)
    {
        return $point->update($request->all());
    }

    public function show(Point $point)
    {
        return $point;
    }

    public function destroy(Point $point)
    {
        $point->delete();

        return response("OK", 200);
    }
}
