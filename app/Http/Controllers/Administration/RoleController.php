<?php

namespace App\Http\Controllers\Administration;

use App\Http\Controllers\Controller;
use App\Http\Requests\RoleRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Yajra\DataTables\DataTables;

class RoleController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
        $this->middleware('permission:role-list');
        $this->middleware('permission:role-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:role-edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:role-delete', ['only' => ['destroy']]);

    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('administration.pages.roles.index');
    }

    public function roles_index_ajax()
    {
        $roles = Role::get();

        return DataTables::of($roles)
            ->setRowId(function ($role) {
                return $role->id;
            })
            ->addColumn('action', function ($role) {
                return '
            <a href=' . route("admin.role.show", $role->id) . '><button class="btn btn-warning">Show</button></a>
            <a href=' . route("admin.role.edit", $role->id) . '><button class="btn btn-info">Edit</button></a>

            <a onclick="event.preventDefault(); document.getElementById(\'' . $role->id . '-button-logout\').submit();"  href="#"><button class="btn btn-danger">Delete</button></a>
            <form id="' . $role->id . '-button-logout" action=' . route("admin.role.destroy", $role->id) . ' method="post">
           <input type="hidden" name="_token" value= ' . csrf_token() . '>
                <input name="_method" type="hidden" value="delete">
            </form>
            ';
            })
            ->rawColumns(['action'])
            ->make(true);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $permissions = Permission::get();
        return view('administration.pages.roles.create')->with([
            'permissions' => $permissions,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(RoleRequest $request)
    {
        $role = new Role();
        DB::transaction(function () use ($request, $role) {
            $role->guard_name = 'admin';
            $role->name = $request->name;
            $role->save();
            $role->givePermissionTo($request->permissions);
        });
        return redirect()->route('admin.role.edit', $role->id)->with('success', 'Role Created Successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show(Role $role)
    {
        return view('administration.pages.roles.show')->with([
            'role' => $role,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Role $role)
    {
        $role_permissions = $role->permissions->pluck('id')->toArray();
        $permissions = Permission::get();
        return view('administration.pages.roles.edit')->with([
            'role' => $role,
            'permissions' => $permissions,
            'role_permissions' => $role_permissions,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(RoleRequest $request, Role $role)
    {
        DB::transaction(function () use ($request, $role) {

            $role->name = $request->name;
            $role->update();
            $role->syncPermissions($request->permissions);
        });
        return redirect()->route('admin.role.edit', $role->id)->with('success', 'Role Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Role $role)
    {
        $role->delete();
        return redirect()->route('admin.roles.index');
    }
}
