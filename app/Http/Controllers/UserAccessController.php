<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class UserAccessController extends Controller
{
    public function index()
    {
        abort_unless(auth()->user()->can('users.view'), 403);

        return view('dashboard.users.index', [
            'users' => User::with(['roles', 'permissions'])->get(),
            'roles' => Role::where('guard_name', 'web')->get(),
            'permissions' => Permission::where('guard_name', 'web')->get(),
        ]);
    }

    public function updateRoles(Request $request, User $user)
    {
        abort_unless(auth()->user()->can('assignments.manage'), 403);

        $data = $request->validate([
            'roles' => 'nullable|array',
            'roles.*' => 'string|exists:roles,name',
        ]);

        $user->syncRoles($data['roles'] ?? []);

        return back()->with('status', 'User roles updated.');
    }

    public function updatePermissions(Request $request, User $user)
    {
        abort_unless(auth()->user()->can('assignments.manage'), 403);

        $data = $request->validate([
            'permissions' => 'nullable|array',
            'permissions.*' => 'string|exists:permissions,name',
        ]);

        $user->syncPermissions($data['permissions'] ?? []);

        return back()->with('status', 'User direct permissions updated.');
    }
}
