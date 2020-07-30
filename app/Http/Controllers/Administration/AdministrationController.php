<?php

namespace App\Http\Controllers\Administration;

use App\Http\Controllers\Controller;
use App\Http\Requests\AdministrationRequest;
use App\Http\Requests\UserRequest;
use App\Models\Admin;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Yajra\DataTables\DataTables;

class AdministrationController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
        $this->middleware('permission:administration-list');
        $this->middleware('permission:administration-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:administration-edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:administration-delete', ['only' => ['destroy']]);

    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('administration.pages.administrations.index');
    }

    public function administrations_index_ajax()
    {
        $administrations = Admin::get();

        return DataTables::of($administrations)
            ->setRowId(function ($administration) {
                return $administration->id;
            })
            ->addColumn('action', function ($administration) {
                return '
            <a href=' . route("admin.administration.show", $administration->id) . '><button class="btn btn-warning">Show</button></a>
            <a href=' . route("admin.administration.edit", $administration->id) . '><button class="btn btn-info">Edit</button></a>

            <a onclick="event.preventDefault(); document.getElementById(\'' . $administration->id . '-button-logout\').submit();"  href="#"><button class="btn btn-danger">Delete</button></a>
            <form id="' . $administration->id . '-button-logout" action=' . route("admin.administration.destroy", $administration->id) . ' method="post">
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
        $roles = Role::get();
        return view('administration.pages.administrations.create')->with([
            'roles' => $roles,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(AdministrationRequest $request)
    {
        $administration = new Admin();
        DB::transaction(function () use ($request, $administration) {
            $administration->name = $request->name;
            $administration->email = $request->email;
            $administration->password = $request->password;
            $administration->save();

            $administration->syncRoles($request->roles);
        });

        return redirect()->route('admin.administration.edit', $administration->id)->with('success', 'Administration Created Successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show(Admin $administration)
    {

        return view('administration.pages.administrations.show')->with([
            'administration' => $administration,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Admin $administration)
    {
        $roles_administration = $administration->roles->pluck('id')->toArray();
        $roles = Role::get();
        return view('administration.pages.administrations.edit')->with([
            'administration' => $administration,
            'roles' => $roles,
            'roles_administration' => $roles_administration,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(AdministrationRequest $request, Admin $administration)
    {
        DB::transaction(function () use ($request, $administration) {
            $administration->name = $request->name;
            $administration->email = $request->email;

            if ($request->password) {
                $administration->password = Hash::make($request->password);
            }
            $administration->update();

            $administration->syncRoles($request->roles);
        });

        return redirect()->route('admin.administration.edit', $administration->id)->with('success', 'Administration Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Admin $administration)
    {
        $administration->delete();
        return redirect()->route('admin.administrations.index');
    }
}
