@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
    <div class="max-w-4xl mx-auto p-4 space-y-6">
        <div class="flex items-center justify-between">
            <div>
                <h1 class="text-2xl font-bold">Welcome, {{ $user->first_name }}</h1>
            </div>

            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit" class="btn btn-error btn-sm text-white">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor"
                         class="size-5 inline">
                        <path fill-rule="evenodd"
                              d="M3 4.25A2.25 2.25 0 0 1 5.25 2h5.5A2.25 2.25 0 0 1 13 4.25v2a.75.75 0 0 1-1.5 0v-2a.75.75 0 0 0-.75-.75h-5.5a.75.75 0 0 0-.75.75v11.5c0 .414.336.75.75.75h5.5a.75.75 0 0 0 .75-.75v-2a.75.75 0 0 1 1.5 0v2A2.25 2.25 0 0 1 10.75 18h-5.5A2.25 2.25 0 0 1 3 15.75V4.25Z"
                              clip-rule="evenodd" />
                        <path fill-rule="evenodd"
                              d="M6 10a.75.75 0 0 1 .75-.75h9.546l-1.048-.943a.75.75 0 1 1 1.004-1.114l2.5 2.25a.75.75 0 0 1 0 1.114l-2.5 2.25a.75.75 0 1 1-1.004-1.114l1.048-.943H6.75A.75.75 0 0 1 6 10Z"
                              clip-rule="evenodd" />
                    </svg>
                    Logout
                </button>
            </form>
        </div>

        @if(session('status'))
            <x-alert-success>{{ session('status') }}</x-alert-success>
        @endif

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
            <div class="card bg-base-100 border-base-content shadow-lg">
                <div class="card-body">
                    <h2 class="card-title text-base">My Profile</h2>
                    <p class="text-sm opacity-70">View your personal details and account info.</p>
                    <a href="{{ route('dashboard.profile.show') }}" class="btn btn-sm mt-2 btn-primary btn-soft">Open
                        Profile</a>
                </div>
            </div>

            <div class="card bg-base-100 border-base-content shadow-lg">
                <div class="card-body">
                    <h2 class="card-title text-base">My Account</h2>
                    <p class="text-sm opacity-70">Edit profile and personal information.</p>
                    <a href="{{ route('dashboard.profile.edit') }}" class="btn btn-sm mt-2 btn-info btn-soft">Edit
                        Profile</a>
                </div>
            </div>

            <div class="card bg-base-100 border-base-content shadow-lg">
                <div class="card-body">
                    <h2 class="card-title text-base">My Access</h2>
                    <p class="text-sm opacity-70">Your active
                        role(s): {{ $user->getRoleNames()->implode(', ') ?: 'None' }}</p>
                    <a href="{{ route('dashboard.profile.show') }}" class="btn btn-sm mt-2 btn-secondary btn-soft">See
                        Access Details</a>
                </div>
            </div>

            @can('users.view')
                <div class="card bg-base-100 shadow">
                    <div class="card-body">
                        <h2 class="card-title text-base">Users</h2>
                        <p>Total users: <strong>{{ $usersCount ?? 0 }}</strong></p>
                        <a href="{{ route('dashboard.users.index') }}" class="btn btn-sm mt-2 btn-success btn-soft">Manage
                            Users</a>
                    </div>
                </div>
            @endcan

            @can('roles.view')
                <div class="card bg-base-100 shadow">
                    <div class="card-body">
                        <h2 class="card-title text-base">Roles</h2>
                        <p>Total roles: <strong>{{ $rolesCount ?? 0 }}</strong></p>
                        <a href="{{ route('dashboard.roles.index') }}" class="btn btn-sm mt-2 btn-accent btn-soft">Manage
                            Roles</a>
                    </div>
                </div>
            @endcan

            @can('permissions.view')
                <div class="card bg-base-100 shadow">
                    <div class="card-body">
                        <h2 class="card-title text-base">Permissions</h2>
                        <p>Total permissions: <strong>{{ $permissionsCount ?? 0 }}</strong></p>
                        <a href="{{ route('dashboard.permissions.index') }}"
                           class="btn btn-sm mt-2 btn-warning btn-soft">Manage
                            Permissions</a>
                    </div>
                </div>
            @endcan
        </div>
    </div>
@endsection
