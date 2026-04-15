<?php

namespace App\Http\Controllers;

use App\Models\User;

class DashboardController extends Controller
{
    public function index()
    {
        // get the authenticated user
        $user = auth()->user();

        // check if the user has permission to view the dashboard
        abort_unless($user->can('dashboard.view'), 403);

        // return the dashboard view with relevant data based on user permissions
        return view('dashboards.index', [
            'user' => $user,
            'usersCount' => $user->can('users.view') ? User::count() : null,
            'rolesCount' => $user->can('roles.view') ? \Spatie\Permission\Models\Role::count() : null,
            'permissionsCount' => $user->can('permissions.view') ? \Spatie\Permission\Models\Permission::count() : null,
        ]);
    }
}
