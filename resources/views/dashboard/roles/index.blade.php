@extends('layouts.app')

@section('title', 'Role Management')

@section('content')
        <div class="max-w-7xl mx-auto p-4 space-y-6">

        <div class="flex items-center justify-between">
            <h1 class="text-2xl font-bold">Role Management</h1>
            <a href="{{ route('dashboard') }}" class="btn btn-sm">Back to Dashboard</a>
        </div>

        @if(session('status'))
            <x-alert-success>{{ session('status') }}</x-alert-success>
        @endif

        @if($errors->any())
            <x-alert-error>{{ $errors->first() }}</x-alert-error>
        @endif

        @can('roles.manage')
            <div class="card bg-base-100 shadow">
                <div class="card-body">
                    <h2 class="card-title">Create Role</h2>

                    <form method="POST" action="{{ route('dashboard.roles.store') }}" class="space-y-4">
                        @csrf

                        <div>
                            <label for="name">Role Name</label>
                            <input id="name" name="name" type="text" class="input input-bordered w-full" required>
                        </div>

                        <div>
                            <label for="permissions">Permissions</label>
                            <select id="permissions" name="permissions[]" class="select select-bordered w-full" multiple>
                                @foreach($permissions as $permission)
                                    <option value="{{ $permission->name }}">{{ $permission->name }}</option>
                                @endforeach
                            </select>
                            <p class="text-xs opacity-70 mt-1">Hold Ctrl/Cmd to select multiple.</p>
                        </div>

                        <button type="submit" class="btn btn-primary btn-sm">Create Role</button>
                    </form>
                </div>
            </div>
        @endcan

        <div class="card bg-base-100 shadow">
            <div class="card-body">
                <h2 class="card-title">All Roles</h2>

                <div class="overflow-x-auto">
                    <table class="table table-zebra">
                        <thead>
                        <tr>
                            <th>Name</th>
                            <th>Permissions</th>
                            @can('roles.manage')
                                <th>Actions</th>
                            @endcan
                        </tr>
                        </thead>
                        <tbody>
                        @forelse($roles as $role)
                            <tr>
                                <td class="font-semibold">{{ $role->name }}</td>
                                <td>{{ $role->permissions->pluck('name')->implode(', ') ?: 'None' }}</td>

                                @can('roles.manage')
                                    <td class="space-y-2 min-w-[320px]">
                                        <form method="POST" action="{{ route('dashboard.roles.update', $role) }}" class="space-y-2">
                                            @csrf
                                            @method('PUT')

                                            <input
                                                type="text"
                                                name="name"
                                                value="{{ $role->name }}"
                                                class="input input-bordered input-sm w-full"
                                                required
                                            >

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

                                            <button type="submit" class="btn btn-info btn-xs">Update</button>
                                        </form>

                                        <form method="POST" action="{{ route('dashboard.roles.destroy', $role) }}">
                                            @csrf
                                            @method('DELETE')

                                            <button
                                                type="submit"
                                                class="btn btn-error btn-xs"
                                                @disabled($role->name === 'admin')
                                            >
                                                Delete
                                            </button>
                                        </form>
                                    </td>
                                @endcan
                            </tr>
                        @empty
                            <tr>
                                <td colspan="{{ auth()->user()->can('roles.manage') ? 3 : 2 }}" class="text-center">
No roles found.</td>
                            </tr>
                        @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
</div>
@endsection
