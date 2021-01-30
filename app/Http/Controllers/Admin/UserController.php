<?php

namespace App\Http\Controllers\Admin;

use App\Models\Role;
use App\Models\User;
use App\Models\Branch;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use Yajra\DataTables\Facades\DataTables;
use Symfony\Component\HttpFoundation\Request;

class UserController extends Controller
{
    public function __construct()
    {
        $this->authorizeResource(User::class, 'user');
    }

    public function index(Request $request)
    {
        //abort_unless(\Gate::allows('user_edit'), 403);

        if ($request->ajax()) {
            $query = User::query()->select('*');
            $query->with(['branch']);

            $table = Datatables::of($query);

            $table->addColumn('actions', 'Actions');
            $table->removeColumn('password');

            $table->editColumn('actions', function ($row) {
                $viewGate = 'view';
                $editGate = 'update';
                $deleteGate = 'delete';
                $crudRoutePart = 'users';

                return view('partials.datatablesActions', compact(
                    'viewGate',
                    'editGate',
                    'deleteGate',
                    'crudRoutePart',
                    'row'
                ));
            });

            $table->rawColumns(['actions']);

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
        $roles = Role::all()->pluck('title', 'id');
        $branches = Branch::all()->pluck('title', 'id');

        return view('admin.users.create', compact('roles', 'branches'));
    }

    public function store(StoreUserRequest $request)
    {
        $user = User::create($request->all());
        $user->roles()->sync($request->input('roles', []));

        return redirect()->route('admin.users.index');
    }

    public function edit(User $user)
    {
        $roles = Role::all()->pluck('title', 'id');
        $branches = Branch::all()->pluck('title', 'id');

        $user->load('roles');
        $user->load('branch');

        return view('admin.users.edit', compact('roles', 'branches', 'user'));
    }

    public function update(UpdateUserRequest $request, User $user)
    {
        $user->update($request->all());
        $user->roles()->sync($request->input('roles', []));

        return redirect()->route('admin.users.index');
    }

    public function show(User $user)
    {
        $user->load('roles');

        return view('admin.users.show', compact('user'));
    }

    public function destroy(User $user)
    {
        $user->delete();

        return back();
    }
}
