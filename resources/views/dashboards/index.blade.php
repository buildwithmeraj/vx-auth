@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
    <div class="max-w-7xl mx-auto p-4 space-y-6">
        <div class="flex items-center justify-between">
            <div>
                <h1 class="text-2xl font-bold">Dashboard</h1>
                <p class="text-sm opacity-70">
                    Welcome, {{ $user->first_name }} {{ $user->last_name }}
                </p>
            </div>

            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit" class="btn btn-error btn-sm text-white">Logout</button>
            </form>
        </div>

        @if(session('status'))
            <x-alert-success>{{ session('status') }}</x-alert-success>
        @endif

        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
            <div class="card bg-base-100 shadow">
                <div class="card-body">
                    <h2 class="card-title text-base">Profile</h2>
                    <p><strong>User ID:</strong> {{ $user->userID }}</p>
                    <p><strong>Email:</strong> {{ $user->email }}</p>
                    <p><strong>Roles:</strong> {{ $user->getRoleNames()->implode(', ') ?: 'None' }}</p>
                </div>
            </div>

            @can('users.view')
                <div class="card bg-base-100 shadow">
                    <div class="card-body">
                        <h2 class="card-title text-base">Users</h2>
                        <p>Total users: <strong>{{ $usersCount ?? 0 }}</strong></p>
                        <a href="{{ route('dashboard.users.index') }}" class="btn btn-sm mt-2">Manage Users</a>
                    </div>
                </div>
            @endcan

            @can('roles.view')
                <div class="card bg-base-100 shadow">
                    <div class="card-body">
                        <h2 class="card-title text-base">Roles</h2>
                        <p>Total roles: <strong>{{ $rolesCount ?? 0 }}</strong></p>
                        <a href="{{ route('dashboard.roles.index') }}" class="btn btn-sm mt-2">Manage Roles</a>
                    </div>
                </div>
            @endcan

            @can('permissions.view')
                <div class="card bg-base-100 shadow">
                    <div class="card-body">
                        <h2 class="card-title text-base">Permissions</h2>
                        <p>Total permissions: <strong>{{ $permissionsCount ?? 0 }}</strong></p>
                        <a href="{{ route('dashboard.permissions.index') }}" class="btn btn-sm mt-2">Manage Permissions</a>
                    </div>
                </div>
            @endcan
        </div>
    </div>
@endsection
