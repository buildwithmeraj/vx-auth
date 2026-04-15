@extends('layouts.app')

@section('title', 'User Access Management')

@section('content')
    <div class="max-w-7xl mx-auto p-4 space-y-6">
        <div class="flex items-center justify-between">
            <h1 class="text-2xl font-bold">User Access Management</h1>
            <a href="{{ route('dashboard') }}" class="btn btn-sm">Back to Dashboard</a>
        </div>

        @if(session('status'))
            <x-alert-success>{{ session('status') }}</x-alert-success>
        @endif

        @if($errors->any())
            <x-alert-error>{{ $errors->first() }}</x-alert-error>
        @endif

        <div class="card bg-base-100 shadow">
            <div class="card-body">
                <h2 class="card-title">Users</h2>

                <div class="overflow-x-auto">
                    <table class="table table-zebra">
                        <thead>
                        <tr>
                            <th>User ID</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Roles</th>
                            <th>Direct Permissions</th>
                            @can('assignments.manage')
                                <th>Manage Access</th>
                            @endcan
                        </tr>
                        </thead>
                        <tbody>
                        @forelse($users as $u)
                            <tr>
                                <td>{{ $u->userID }}</td>
                                <td>{{ $u->first_name }} {{ $u->last_name }}</td>
                                <td>{{ $u->email }}</td>
                                <td>{{ $u->getRoleNames()->implode(', ') ?: 'None' }}</td>
                                <td>{{ $u->getDirectPermissions()->pluck('name')->implode(', ') ?: 'None' }}</td>

                                @can('assignments.manage')
                                    <td class="space-y-3 min-w-[340px]">
                                        <form method="POST" action="{{ route('dashboard.users.roles.update', $u) }}" class="space-y-2">
                                            @csrf
                                            @method('PUT')

                                            <label class="font-medium">Roles</label>
                                            <select name="roles[]" class="select select-bordered select-sm w-full" multiple>
                                                @foreach($roles as $role)
                                                    @php
                                                        $isSelf = auth()->id() === $u->id;
                                                        $isAdminRole = $role->name === 'admin';
                                                        $currentlyHasAdmin = $u->hasRole('admin');
                                                        $disableSelfAdminRemoval = $isSelf && $isAdminRole && $currentlyHasAdmin;
                                                    @endphp

                                                    <option
                                                        value="{{ $role->name }}"
                                                        @selected($u->hasRole($role->name))
                                                        @disabled($disableSelfAdminRemoval)
                                                    >
                                                        {{ $role->name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            <button type="submit" class="btn btn-info btn-xs">Update Roles</button>
                                        </form>

                                        <form method="POST" action="{{ route('dashboard.users.permissions.update', $u) }}" class="space-y-2">
                                            @csrf
                                            @method('PUT')

                                            <label class="font-medium">Direct Permissions</label>
                                            <select name="permissions[]" class="select select-bordered select-sm w-full" multiple>
                                                @foreach($permissions as $permission)
                                                    <option
                                                        value="{{ $permission->name }}"
                                                        @selected($u->hasDirectPermission($permission->name))
                                                    >
                                                        {{ $permission->name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            <button type="submit" class="btn btn-primary btn-xs">Update Permissions</button>
                                        </form>
                                    </td>
                                @endcan
                            </tr>
                        @empty
                            <tr>
                                <td colspan="{{ auth()->user()->can('assignments.manage') ? 6 : 5 }}" class="text-center">
                                    No users found.
                                </td>
                            </tr>
                        @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection