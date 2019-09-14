<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyPointRequest;
use App\Http\Requests\StorePointRequest;
use App\Http\Requests\UpdatePointRequest;
use App\Point;

class PointController extends Controller
{
    public function index()
    {
        abort_unless(\Gate::allows('point_access'), 403);

        $points = Point::all();

        return view('admin.points.index', compact('points'));
    }

    public function create()
    {
        abort_unless(\Gate::allows('point_create'), 403);

        return view('admin.points.create');
    }

    public function store(StorePointRequest $request)
    {
        abort_unless(\Gate::allows('point_create'), 403);

        $point = Point::create($request->all());

        return redirect()->route('admin.points.index');
    }

    public function edit(Point $point)
    {
        abort_unless(\Gate::allows('point_edit'), 403);

        return view('admin.points.edit', compact('point'));
    }

    public function update(UpdatePointRequest $request, Point $point)
    {
        abort_unless(\Gate::allows('point_edit'), 403);

        $point->update($request->all());

        return redirect()->route('admin.points.index');
    }

    public function show(Point $point)
    {
        abort_unless(\Gate::allows('point_show'), 403);

        return view('admin.points.show', compact('point'));
    }

    public function destroy(Point $point)
    {
        abort_unless(\Gate::allows('point_delete'), 403);

        $point->delete();

        return back();
    }

    public function massDestroy(MassDestroyPointRequest $request)
    {
        Point::whereIn('id', request('ids'))->delete();

        return response(null, 204);
    }
}
