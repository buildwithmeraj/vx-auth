@extends('layouts.app')

@section('title', 'Role Management')

@section('content')
    <div class="max-w-4xl mx-auto p-4 space-y-6">
        <div class="flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
            <div>
                <h1 class="text-2xl font-bold">Role Management</h1>
                <p class="text-sm opacity-70">Create roles and control which permissions they include.</p>
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
                    <p class="text-xs uppercase opacity-60">Total Roles</p>
                    <p class="text-2xl font-bold">{{ $roles->count() }}</p>
                </div>
            </div>
            <div class="card bg-base-100 shadow">
                <div class="card-body p-4">
                    <p class="text-xs uppercase opacity-60">Permissions Available</p>
                    <p class="text-2xl font-bold">{{ $permissions->count() }}</p>
                </div>
            </div>
            <div class="card bg-base-100 shadow">
                <div class="card-body p-4">
                    <p class="text-xs uppercase opacity-60">Admin Role</p>
                    <p class="text-2xl font-bold">{{ $roles->contains('name', 'admin') ? 'Protected' : 'Missing' }}</p>
                </div>
            </div>
        </div>

        @can('roles.manage')
    <div class="collapse collapse-arrow bg-base-100 border border-base-300 shadow">
        <input type="checkbox" />
        <div class="collapse-title text-base font-semibold">
            Create New Role
        </div>
        <div class="collapse-content">
            <form method="POST" action="{{ route('dashboard.roles.store') }}" class="space-y-4 pt-2">
                @csrf

                <div>
                    <label for="name">Role Name</label>
                    <input
                        id="name"
                        name="name"
                        type="text"
                        placeholder="manager"
                        class="input input-bordered w-full"
                        value="{{ old('name') }}"
                        required
                    >
                </div>

                <div>
                    <label for="permissions">Permissions</label>
                    <select id="permissions" name="permissions[]" class="select select-bordered w-full" multiple>
                        @foreach($permissions as $permission)
                            <option
                                value="{{ $permission->name }}"
                                @selected(collect(old('permissions', []))->contains($permission->name))
                            >
                                {{ $permission->name }}
                            </option>
                        @endforeach
                    </select>
                    <p class="text-xs opacity-60 mt-1">Hold Ctrl/Cmd to select multiple permissions.</p>
                </div>

                <button type="submit" class="btn btn-primary btn-sm gap-1">
                    <svg xmlns="http://www.w3.org/2000/svg" class="size-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M12 4.5v15m7.5-7.5h-15"/>
                    </svg>
                    Create Role
                </button>
            </form>
        </div>
    </div>
@endcan
        

        <h2 class="font-semibold text-xl">All Roles</h2>
        <div class="card bg-base-100 shadow">
            <div class="card-body p-0">
                
                <div class="md:hidden p-4 space-y-4">
                    @forelse($roles as $role)
                        <div class="rounded-box border border-base-300 p-4 space-y-3">
                            <div class="flex items-start justify-between gap-2">
                                <div>
                                    <div class="font-semibold text-base">{{ $role->name }}</div>
                                    @if($role->name === 'admin')
                                        <span class="badge badge-warning badge-sm mt-1">Protected</span>
                                    @endif
                                </div>
                            </div>

                            <div>
                                <p class="text-xs uppercase opacity-60 mb-1">Permissions</p>
                                <div class="flex flex-wrap gap-1">
                                    @forelse($role->permissions->pluck('name') as $permissionName)
                                        <span class="badge badge-outline badge-sm">{{ $permissionName }}</span>
                                    @empty
                                        <span class="text-xs opacity-60">None</span>
                                    @endforelse
                                </div>
                            </div>

                            @can('roles.manage')
                                <div class="collapse collapse-arrow bg-base-200 border border-base-300 mt-2">
                                    <input type="checkbox" />
                                    <div class="collapse-title text-sm font-semibold">
                                        Edit Role
                                    </div>
                                    <div class="collapse-content space-y-4">
                                        <form method="POST" action="{{ route('dashboard.roles.update', $role) }}" class="space-y-2">
                                            @csrf
                                            @method('PUT')

                                            <label class="font-medium">Role Name</label>
                                            <input
                                                type="text"
                                                name="name"
                                                value="{{ $role->name }}"
                                                class="input input-bordered input-sm w-full"
                                                required
                                            >

                                            <label class="font-medium">Permissions</label>
                                            <select name="permissions[]" class="select select-bordered select-sm w-full" multiple>
                                                @foreach($permissions as $permission)
                                                    <option
                                                        value="{{ $permission->name }}"
                                                        @selected($role->permissions->contains('name', $permission->name))
                                                    >
                                                        {{ $permission->name }}
                                                    </option>
                                                @endforeach
                                            </select>

                                            <button type="submit" class="btn btn-info btn-xs w-full gap-1">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="size-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M16.862 4.487a2.1 2.1 0 1 1 2.97 2.97L8.25 19.04 4.5 19.5l.46-3.75 11.902-11.263Z"/>
                                                </svg>
                                                Update Role
                                            </button>
                                        </form>

                                        <form method="POST" action="{{ route('dashboard.roles.destroy', $role) }}">
                                            @csrf
                                            @method('DELETE')

                                            <button
                                                type="submit"
                                                class="btn btn-error btn-xs w-full gap-1"
                                                @disabled($role->name === 'admin')
                                            >
                                                <svg xmlns="http://www.w3.org/2000/svg" class="size-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916A2.25 2.25 0 0 0 13.5 2.25h-3a2.25 2.25 0 0 0-2.25 2.25v.916m7.5 0h-7.5"/>
                                                </svg>
                                                Delete Role
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            @endcan
                        </div>
                    @empty
                        <div class="text-center py-6 opacity-70">No roles found.</div>
                    @endforelse
                </div>

                <div class="hidden md:block overflow-x-auto">
                    <table class="table">
                        <thead>
                        <tr>
                            <th>Role</th>
                            <th>Permissions</th>
                            @can('roles.manage')
                                <th class="w-[420px]">Manage</th>
                            @endcan
                        </tr>
                        </thead>
                        <tbody>
                        @forelse($roles as $role)
                            <tr>
                                <td>
                                    <div class="flex items-center gap-2">
                                        <span class="font-semibold">{{ $role->name }}</span>
                                        @if($role->name === 'admin')
                                            <span class="badge badge-warning badge-sm">Protected</span>
                                        @endif
                                    </div>
                                </td>
                                <td>
                                    <div class="flex flex-wrap gap-1">
                                        @forelse($role->permissions->pluck('name') as $permissionName)
                                            <span class="badge badge-outline badge-sm">{{ $permissionName }}</span>
                                        @empty
                                            <span class="text-xs opacity-60">None</span>
                                        @endforelse
                                    </div>
                                </td>

                                @can('roles.manage')
                                    <td>
                                        <div class="collapse collapse-arrow bg-base-200 border border-base-300">
                                            <input type="checkbox" />
                                            <div class="collapse-title text-sm font-semibold">
                                                Edit Role
                                            </div>
                                            <div class="collapse-content space-y-4">
                                                <form method="POST" action="{{ route('dashboard.roles.update', $role) }}" class="space-y-2">
                                                    @csrf
                                                    @method('PUT')

                                                    <label class="font-medium">Role Name</label>
                                                    <input
                                                        type="text"
                                                        name="name"
                                                        value="{{ $role->name }}"
                                                        class="input input-bordered input-sm w-full"
                                                        required
                                                    >

                                                    <label class="font-medium">Permissions</label>
                                                    <select name="permissions[]" class="select select-bordered select-sm w-full" multiple>
                                                        @foreach($permissions as $permission)
                                                            <option
                                                                value="{{ $permission->name }}"
                                                                @selected($role->permissions->contains('name', $permission->name))
                                                            >
                                                                {{ $permission->name }}
                                                            </option>
                                                        @endforeach
                                                    </select>

                                                    <button type="submit" class="btn btn-info btn-xs gap-1">
                                                        <svg xmlns="http://www.w3.org/2000/svg" class="size-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M16.862 4.487a2.1 2.1 0 1 1 2.97 2.97L8.25 19.04 4.5 19.5l.46-3.75 11.902-11.263Z"/>
                                                        </svg>
                                                        Update Role
                                                    </button>
                                                </form>

                                                <form method="POST" action="{{ route('dashboard.roles.destroy', $role) }}">
                                                    @csrf
                                                    @method('DELETE')

                                                    <button
                                                        type="submit"
                                                        class="btn btn-error btn-xs gap-1"
                                                        @disabled($role->name === 'admin')
                                                    >
                                                        <svg xmlns="http://www.w3.org/2000/svg" class="size-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916A2.25 2.25 0 0 0 13.5 2.25h-3a2.25 2.25 0 0 0-2.25 2.25v.916m7.5 0h-7.5"/>
                                                        </svg>
                                                        Delete Role
                                                    </button>
                                                </form>
                                            </div>
                                        </div>
                                    </td>
                                @endcan
                            </tr>
                        @empty
                            <tr>
                                <td colspan="{{ auth()->user()->can('roles.manage') ? 3 : 2 }}" class="text-center py-6">
                                    No roles found.
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
