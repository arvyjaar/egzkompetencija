<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Branch;
use App\Models\Report;
use App\Models\Worktype;
use App\Models\User;
use Yajra\DataTables\DataTables;
use Yajra\DataTables\Html\Builder;

class StatsController extends Controller
{
    public function index(Request $request, Builder $builder)
    {
        return "Still in progress";

        $worktypes = Worktype::pluck('title', 'id')->prepend('---', '');
        $branches = Branch::pluck('title', 'id')->prepend('---', '');
        
        if (request()->ajax()) {
            $query = User::query()->select('*');
            $query->with(['branch']);

            $table = Datatables::of($query);

            return $table->toJson();
        }

        $html = $builder->columns([
                ['data' => 'name', 'title' => trans('cruds.user.fields.name')],
                ['data' => 'branch', 'title' => trans('cruds.branch.title')],
        ]);
        
        return view('admin.statistics.index', compact('worktypes', 'branches', 'html'));
    }

    public function getMultiFilterSelect()
    {
        return view('admin.statistics.index');
    }

    public function getMultiFilterSelectData()
    {
        $users = User::select(['id', 'name', 'email', 'created_at', 'updated_at'])->get();

        return Datatables::of($users)->make(true);
    }
}
