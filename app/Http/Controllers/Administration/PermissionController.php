<?php

namespace App\Http\Controllers\Administration;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Yajra\DataTables\DataTables;

class PermissionController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth:admin');
        $this->middleware('permission:permission-list');
    }

    public function index()
    {
        return view('administration.pages.permissions.index');
    }


    public function permissions_index_ajax()
    {
        $users = Permission::get();

        return DataTables::of($users)
            ->setRowId(function ($user) {
                return $user->id;
            })
            ->addColumn('action', function ($user) {
                return '
            <a href=' . route("admin.permission.show", $user->id) . '><button class="btn btn-warning">Show</button></a>
            ';
            })
            ->rawColumns(['action'])
            ->make(true);
    }

    public function show(Permission $permission)
    {
        return view('administration.pages.permissions.show')->with([
            'permission' => $permission,
        ]);
    }
}
