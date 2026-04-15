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
        abort_unless(auth()->user()->can('roles.view'), 403);

        return view('dashboard.roles.index', [
            'roles' => Role::with('permissions')->where('guard_name', 'web')->get(),
            'permissions' => Permission::where('guard_name', 'web')->get(),
        ]);
    }

    public function store(Request $request)
    {
        abort_unless(auth()->user()->can('roles.manage'), 403);

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

        $role->syncPermissions($data['permissions'] ?? []);

        return back()->with('status', 'Role created.');
    }

    public function update(Request $request, Role $role)
    {
        abort_unless(auth()->user()->can('roles.manage'), 403);
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

        $role->update(['name' => $data['name']]);
        $role->syncPermissions($data['permissions'] ?? []);

        return back()->with('status', 'Role updated.');
    }

    public function destroy(Role $role)
    {
        abort_unless(auth()->user()->can('roles.manage'), 403);
        abort_unless($role->guard_name === 'web', 404);

        if ($role->name === 'admin') {
            return back()->withErrors(['role' => 'Admin role cannot be deleted.']);
        }

        $role->delete();

        return back()->with('status', 'Role deleted.');
    }
}
