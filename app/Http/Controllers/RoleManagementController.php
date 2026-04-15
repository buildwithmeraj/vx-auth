<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleManagementController extends Controller
{
    public function index()
    {
        // only users with 'roles.view' permission can access this page
        abort_unless(auth()->user()->can('roles.view'), 403);

        // load all roles with their permissions, and all permissions for the form
        return view('dashboard.roles.index', [
            'roles' => Role::with('permissions')->where('guard_name', 'web')->get(),
            'permissions' => Permission::where('guard_name', 'web')->get(),
        ]);
    }

    public function store(Request $request)
    {
        // only users with 'roles.manage' permission can create roles
        abort_unless(auth()->user()->can('roles.manage'), 403);

        // validate inputs, permissions is an array of existing permission names for web guard
        $data = $request->validate([
            'name' => [
                'required',
                'string',
                'max:50',
                Rule::unique('roles', 'name')->where(fn ($q) => $q->where('guard_name', 'web')),
            ],
            'permissions' => 'nullable|array',
            'permissions.*' => 'string|exists:permissions,name,guard_name,web',
        ]);

        $role = Role::create([
            'name' => $data['name'],
            'guard_name' => 'web',
        ]);

        // assign permissions to the role
        $role->syncPermissions($data['permissions'] ?? []);

        // redirect back with success message
        return back()->with('status', 'Role created.');
    }

    public function update(Request $request, Role $role)
    {
        // only users with 'roles.manage' permission can update roles
        abort_unless(auth()->user()->can('roles.manage'), 403);

        // only allow updating roles for web guard
        abort_unless($role->guard_name === 'web', 404);

        $data = $request->validate([
            'name' => [
                'required',
                'string',
                'max:50',
                Rule::unique('roles', 'name')
                    ->ignore($role->id)
                    ->where(fn ($q) => $q->where('guard_name', 'web')),
            ],
            'permissions' => 'nullable|array',
            'permissions.*' => 'string|exists:permissions,name,guard_name,web',
        ]);

        // prevent renaming admin role
        $role->update(['name' => $data['name']]);

        // sync permissions to the role
        $role->syncPermissions($data['permissions'] ?? []);

        // redirect back with success message
        return back()->with('status', 'Role updated.');
    }

    public function destroy(Role $role)
    {
        // only users with 'roles.manage' permission can delete roles
        abort_unless(auth()->user()->can('roles.manage'), 403);

        // only allow deleting roles for web guard
        abort_unless($role->guard_name === 'web', 404);

        // prevent deleting admin role
        if ($role->name === 'admin') {
            return back()->withErrors(['role' => 'Admin role cannot be deleted.']);
        }

        $role->delete();

        // redirect back with success message
        return back()->with('status', 'Role deleted.');
    }
}
