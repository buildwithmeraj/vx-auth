<?php

namespace App\Http\Controllers;

use App\Models\User;

class DashboardController extends Controller
{
    public function index()
    {
        $user = auth()->user();

        abort_unless($user->can('dashboard.view'), 403);

        return view('dashboards.index', [
            'user' => $user,
            'usersCount' => $user->can('users.view') ? User::count() : null,
            'rolesCount' => $user->can('roles.view') ? \Spatie\Permission\Models\Role::count() : null,
            'permissionsCount' => $user->can('permissions.view') ? \Spatie\Permission\Models\Permission::count() : null,
        ]);
    }
}
