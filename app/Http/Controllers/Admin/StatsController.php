<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Branch;
use App\Models\Report;
use App\Models\Worktype;
use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Yajra\DataTables\DataTables;
use Yajra\DataTables\Html\Builder as HtmlBuilder;

// use Yajra\DataTables\Html\Builder;

class StatsController extends Controller
{
    public function index(Request $request, HtmlBuilder $builder)
    {
        //return "Still in progress";

        $worktypes = Worktype::pluck('title', 'id')->prepend('---', '');
        $branches = Branch::pluck('title', 'id')->prepend('---', '');

        if (request()->ajax()) {
            $users = DataTables::of(User::query()->whereHas('branch', function (Builder $query_branch) use ($request) {
                if ($request->filled('branch_id')) {
                    $query_branch->where('id', $request->branch_id);
                }
            })
            ->with('branch')
            ->withCount(['reportAsEmployee' => function ($query_dates) use ($request) {
                if ($request->filled('date_from')) {
                    $query_dates->where('observing_date', '>=', $request->date_from);
                }
                if ($request->filled('date_to')) {
                    $query_dates->where('observing_date', '<=', $request->date_to);
                }
            }]))
            ->with('params', ['from' => $request->date_from, 'to' => $request->date_to, 'branch' => Branch::find($request->branch_id)->title ?? null])
            ->toJson();

            return $users;
        }

        $html = $builder->columns([
                ['data' => 'name', 'title' => trans('cruds.user.fields.name')],
                ['data' => 'branch.title', 'title' => trans('cruds.branch.title_singular')],
                ['data' => 'report_as_employee_count', 'title' => trans('cruds.report.title'), 'searchable' => false],
            ]);

        return view('admin.statistics.index', compact('worktypes', 'branches', 'html'));
    }
}
