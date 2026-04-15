<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Spatie\Permission\Models\Permission;

class PermissionManagementController extends Controller
{
    public function index()
    {
        abort_unless(auth()->user()->can('permissions.view'), 403);

        return view('dashboard.permissions.index', [
            'permissions' => Permission::where('guard_name', 'web')->get(),
        ]);
    }

    public function store(Request $request)
    {
        abort_unless(auth()->user()->can('permissions.manage'), 403);

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

        return back()->with('status', 'Permission created.');
    }

    public function update(Request $request, Permission $permission)
    {
        abort_unless(auth()->user()->can('permissions.manage'), 403);
        abort_unless($permission->guard_name === 'web', 404);

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

        return back()->with('status', 'Permission updated.');
    }

    public function destroy(Permission $permission)
    {
        abort_unless(auth()->user()->can('permissions.manage'), 403);
        abort_unless($permission->guard_name === 'web', 404);

        $permission->delete();

        return back()->with('status', 'Permission deleted.');
    }
}
