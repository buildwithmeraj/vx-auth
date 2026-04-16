@extends('layouts.app')

@section('title', 'User Access Management')

@section('content')
    <div class="max-w-4xl mx-auto p-4 space-y-6">
        <div class="flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
            <div>
                <h1 class="text-2xl font-bold">User Access Management</h1>
            </div>
            <a href="{{ route('dashboard') }}" class="btn btn-sm btn-primary"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="size-5">
                    <path fill-rule="evenodd"
                          d="M17 10a.75.75 0 0 1-.75.75H5.612l4.158 3.96a.75.75 0 1 1-1.04 1.08l-5.5-5.25a.75.75 0 0 1 0-1.08l5.5-5.25a.75.75 0 1 1 1.04 1.08L5.612 9.25H16.25A.75.75 0 0 1 17 10Z"
                          clip-rule="evenodd" />
                </svg>Back to Dashboard</a>
        </div>

        @if(session('status'))
            <x-alert-success>{{ session('status') }}</x-alert-success>
        @endif

        @if($errors->any())
            <x-alert-error>{{ $errors->first() }}</x-alert-error>
        @endif

        <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
            <div class="card bg-base-100 shadow">
                <div class="card-body p-4">
                    <p class="text-xs uppercase opacity-60">Total Users</p>
                    <p class="text-2xl font-bold">{{ $users->count() }}</p>
                </div>
            </div>
            <div class="card bg-base-100 shadow">
                <div class="card-body p-4">
                    <p class="text-xs uppercase opacity-60">Roles Available</p>
                    <p class="text-2xl font-bold">{{ $roles->count() }}</p>
                </div>
            </div>
            <div class="card bg-base-100 shadow">
                <div class="card-body p-4">
                    <p class="text-xs uppercase opacity-60">Permissions Available</p>
                    <p class="text-2xl font-bold">{{ $permissions->count() }}</p>
                </div>
            </div>
        </div>

        <h2 class="font-semibold text-xl">All Users</h2>
        <div class="card bg-base-100 shadow">
            <div class="card-body p-0">
                <div class="md:hidden p-4 space-y-4">
                    @forelse($users as $u)
                        <div class="rounded-box border border-base-300 p-4 space-y-3">
                            <div class="flex items-center gap-3">
                                <img src="{{ $u->photo }}" alt="{{ $u->first_name }}" class="w-12 h-12 rounded-full object-cover">
                                <div>
                                    <div class="font-semibold">{{ $u->first_name }} {{ $u->last_name }}</div>
                                    <div class="text-xs opacity-70">{{ $u->email }}</div>
                                    <div class="text-xs opacity-60">ID: {{ $u->userID }}</div>
                                </div>
                            </div>

                            <div>
                                <p class="text-xs uppercase opacity-60 mb-1">Roles</p>
                                <div class="flex flex-wrap gap-1">
                                    @forelse($u->getRoleNames() as $roleName)
                                        <span class="badge badge-neutral badge-sm">{{ $roleName }}</span>
                                    @empty
                                        <span class="text-xs opacity-60">None</span>
                                    @endforelse
                                </div>
                            </div>

                            <div>
                                <p class="text-xs uppercase opacity-60 mb-1">Direct Permissions</p>
                                <div class="flex flex-wrap gap-1">
                                    @forelse($u->getDirectPermissions()->pluck('name') as $permissionName)
                                        <span class="badge badge-outline badge-sm">{{ $permissionName }}</span>
                                    @empty
                                        <span class="text-xs opacity-60">None</span>
                                    @endforelse
                                </div>
                            </div>

                            @can('assignments.manage')
                                <div class="collapse collapse-arrow bg-base-200 border border-base-300 mt-2">
                                    <input type="checkbox" />
                                    <div class="collapse-title text-sm font-semibold">
                                        Manage Roles & Permissions
                                    </div>
                                    <div class="collapse-content space-y-4">
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
                                                    <option value="{{ $role->name }}"
                                                            @selected($u->hasRole($role->name))
                                                            @disabled($disableSelfAdminRemoval)>
                                                        {{ $role->name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            <button type="submit" class="btn btn-info btn-xs w-full"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16" fill="currentColor" class="size-4">
  <path fill-rule="evenodd" d="M12.416 3.376a.75.75 0 0 1 .208 1.04l-5 7.5a.75.75 0 0 1-1.154.114l-3-3a.75.75 0 0 1 1.06-1.06l2.353 2.353 4.493-6.74a.75.75 0 0 1 1.04-.207Z" clip-rule="evenodd" />
</svg>
Update Roles</button>
                                        </form>

                                        <form method="POST" action="{{ route('dashboard.users.permissions.update', $u) }}" class="space-y-2">
                                            @csrf
                                            @method('PUT')
                                            <label class="font-medium">Direct Permissions</label>
                                            <select name="permissions[]" class="select select-bordered select-sm w-full" multiple>
                                                @foreach($permissions as $permission)
                                                    <option value="{{ $permission->name }}"
                                                            @selected($u->hasDirectPermission($permission->name))>
                                                        {{ $permission->name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            <button type="submit" class="btn btn-primary btn-xs w-full"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16" fill="currentColor" class="size-4">
  <path fill-rule="evenodd" d="M12.416 3.376a.75.75 0 0 1 .208 1.04l-5 7.5a.75.75 0 0 1-1.154.114l-3-3a.75.75 0 0 1 1.06-1.06l2.353 2.353 4.493-6.74a.75.75 0 0 1 1.04-.207Z" clip-rule="evenodd" />
</svg>
Update Permissions</button>
                                        </form>
                                    </div>
                                </div>
                            @endcan
                        </div>
                    @empty
                        <div class="text-center py-6 opacity-70">No users found.</div>
                    @endforelse
                </div>

                <div class="hidden md:block overflow-x-auto">
                    <table class="table">
                        <thead class="bg-base-100">
                        <tr>
                            <th>User</th>
                            <th>Roles</th>
                            <th>Direct Permissions</th>
                            @can('assignments.manage')
                                <th class="w-[420px]">Manage Access</th>
                            @endcan
                        </tr>
                        </thead>
                        <tbody>
                        @forelse($users as $u)
                            <tr>
                                <td>
                                    <div class="flex items-center gap-3">
                                        <img src="{{ $u->photo }}" alt="{{ $u->first_name }}" class="w-10 h-10 rounded-full object-cover">
                                        <div>
                                            <div class="font-semibold">{{ $u->first_name }} {{ $u->last_name }}</div>
                                            <div class="text-xs opacity-70">{{ $u->email }}</div>
                                            <div class="text-xs opacity-60">ID: {{ $u->userID }}</div>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <div class="flex flex-wrap gap-1">
                                        @forelse($u->getRoleNames() as $roleName)
                                            <span class="badge badge-neutral badge-sm">{{ $roleName }}</span>
                                        @empty
                                            <span class="text-xs opacity-60">None</span>
                                        @endforelse
                                    </div>
                                </td>
                                <td>
                                    <div class="flex flex-wrap gap-1">
                                        @forelse($u->getDirectPermissions()->pluck('name') as $permissionName)
                                            <span class="badge badge-outline badge-sm">{{ $permissionName }}</span>
                                        @empty
                                            <span class="text-xs opacity-60">None</span>
                                        @endforelse
                                    </div>
                                </td>

                                @can('assignments.manage')
                                    <td>
                                        <div class="collapse collapse-arrow bg-base-200 border border-base-300">
                                            <input type="checkbox" />
                                            <div class="collapse-title text-sm font-semibold">
                                                Manage Roles & Permissions
                                            </div>
                                            <div class="collapse-content space-y-4">
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
                                                            <option value="{{ $role->name }}"
                                                                    @selected($u->hasRole($role->name))
                                                                    @disabled($disableSelfAdminRemoval)>
                                                                {{ $role->name }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                    <button type="submit" class="btn btn-info btn-xs"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16" fill="currentColor" class="size-4">
  <path fill-rule="evenodd" d="M12.416 3.376a.75.75 0 0 1 .208 1.04l-5 7.5a.75.75 0 0 1-1.154.114l-3-3a.75.75 0 0 1 1.06-1.06l2.353 2.353 4.493-6.74a.75.75 0 0 1 1.04-.207Z" clip-rule="evenodd" />
</svg>
Update Roles</button>
                                                </form>

                                                <form method="POST" action="{{ route('dashboard.users.permissions.update', $u) }}" class="space-y-2">
                                                    @csrf
                                                    @method('PUT')
                                                    <label class="font-medium">Direct Permissions</label>
                                                    <select name="permissions[]" class="select select-bordered select-sm w-full" multiple>
                                                        @foreach($permissions as $permission)
                                                            <option value="{{ $permission->name }}"
                                                                    @selected($u->hasDirectPermission($permission->name))>
                                                                {{ $permission->name }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                    <button type="submit" class="btn btn-primary btn-xs"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16" fill="currentColor" class="size-4">
  <path fill-rule="evenodd" d="M12.416 3.376a.75.75 0 0 1 .208 1.04l-5 7.5a.75.75 0 0 1-1.154.114l-3-3a.75.75 0 0 1 1.06-1.06l2.353 2.353 4.493-6.74a.75.75 0 0 1 1.04-.207Z" clip-rule="evenodd" />
</svg>
Update Permissions</button>
                                                </form>
                                            </div>
                                        </div>
                                    </td>
                                @endcan
                            </tr>
                        @empty
                            <tr>
                                <td colspan="{{ auth()->user()->can('assignments.manage') ? 4 : 3 }}" class="text-center py-6">
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
