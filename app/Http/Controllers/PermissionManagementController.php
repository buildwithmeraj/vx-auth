<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Spatie\Permission\Models\Permission;

class PermissionManagementController extends Controller
{
    public function index()
    {
        // only users with 'permissions.view' permission can access this page
        abort_unless(auth()->user()->can('permissions.view'), 403);

        // fetch all permissions with 'web' guard and pass to the view
        return view('dashboard.permissions.index', [
            'permissions' => Permission::where('guard_name', 'web')->get(),
        ]);
    }

    public function store(Request $request)
    {
        // only users with 'permissions.manage' permission can create new permissions
        abort_unless(auth()->user()->can('permissions.manage'), 403);

        // validate the request data
        $data = $request->validate([
            'name' => [
                'required',
                'string',
                'max:100',
                Rule::unique('permissions', 'name')->where(fn ($q) => $q->where('guard_name', 'web')),
            ],
        ]);

        Permission::create([
            'name' => $data['name'],
            'guard_name' => 'web',
        ]);

        // redirect back with success message
        return back()->with('status', 'Permission created.');
    }

    public function update(Request $request, Permission $permission)
    {
        // only users with 'permissions.manage' permission can update permissions
        abort_unless(auth()->user()->can('permissions.manage'), 403);
        // only permissions with 'web' guard can be updated through this controller
        abort_unless($permission->guard_name === 'web', 404);

        // validate the request data
        $data = $request->validate([
            'name' => [
                'required',
                'string',
                'max:100',
                Rule::unique('permissions', 'name')
                    ->ignore($permission->id)
                    ->where(fn ($q) => $q->where('guard_name', 'web')),
            ],
        ]);

        $permission->update([
            'name' => $data['name'],
        ]);

        // redirect back with success message
        return back()->with('status', 'Permission updated.');
    }

    public function destroy(Permission $permission)
    {
        // only users with 'permissions.manage' permission can delete permissions
        abort_unless(auth()->user()->can('permissions.manage'), 403);
        // only permissions with 'web' guard can be deleted through this controller
        abort_unless($permission->guard_name === 'web', 404);

        $permission->delete();

        // redirect back with success message
        return back()->with('status', 'Permission deleted.');
    }
}
