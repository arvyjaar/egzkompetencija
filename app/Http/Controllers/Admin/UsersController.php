<?php

namespace App\Http\Controllers\Admin;

use App\Models\Role;
use App\Models\User;
use App\Models\Branch;
use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyUserRequest;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use Yajra\DataTables\Facades\DataTables;
use Symfony\Component\HttpFoundation\Request;

class UsersController extends Controller
{
    public function index(Request $request)
    {
        abort_unless(\Gate::allows('user_edit'), 403);

        if ($request->ajax()) {
            $query = User::query()->select('*');

            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', 'Actions');
            $table->removeColumn('password');

            $table->editColumn('actions', function ($row) {
                $viewGate = 'user_edit';
                $editGate = 'user_edit';
                $deleteGate = 'user_edit';
                $crudRoutePart = 'users';

                return view('partials.datatablesActions', compact(
                    'viewGate',
                    'editGate',
                    'deleteGate',
                    'crudRoutePart',
                    'row'
                ));
            });
            $table->editColumn('branch_id', function ($row) {
                return $row->branch_id ? $row->branch->title : '';
            });

            $table->rawColumns(['actions', 'placeholder']);

            $table->setRowAttr([
                'data-entry-id' => function ($row) {
                    return $row->id;
                },
            ]);

            return $table->make(true);
        }
        
        return view('admin.users.index');
    }

    public function create()
    {
        abort_unless(\Gate::allows('user_edit'), 403);

        $roles = Role::all()->pluck('title', 'id');
        $branches = Branch::all()->pluck('title', 'id');

        return view('admin.users.create', compact('roles', 'branches'));
    }

    public function store(StoreUserRequest $request)
    {
        abort_unless(\Gate::allows('user_edit'), 403);

        $user = User::create($request->all());
        $user->roles()->sync($request->input('roles', []));

        return redirect()->route('admin.users.index');
    }

    public function edit(User $user)
    {
        abort_unless(\Gate::allows('user_edit'), 403);

        $roles = Role::all()->pluck('title', 'id');
        $branches = Branch::all()->pluck('title', 'id');

        $user->load('roles');
        $user->load('branch');

        return view('admin.users.edit', compact('roles', 'branches', 'user'));
    }

    public function update(UpdateUserRequest $request, User $user)
    {
        abort_unless(\Gate::allows('user_edit'), 403);

        $user->update($request->all());
        $user->roles()->sync($request->input('roles', []));

        return redirect()->route('admin.users.index');
    }

    public function show(User $user)
    {
        abort_unless(\Gate::allows('user_edit'), 403);

        $user->load('roles');

        return view('admin.users.show', compact('user'));
    }

    public function destroy(User $user)
    {
        abort_unless(\Gate::allows('user_edit'), 403);

        $user->delete();

        return back();
    }

    public function massDestroy(MassDestroyUserRequest $request)
    {
        abort_unless(\Gate::allows('is_admin'), 403);

        User::whereIn('id', request('ids'))->delete();
        
        return response(null, 204);
    }
}
