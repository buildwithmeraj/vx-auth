@extends('layouts.app')

@section('title', 'Permission Management')

@section('content')
        <div class="max-w-7xl mx-auto p-4 space-y-6">
        <div class="flex items-center justify-between">
            <h1 class="text-2xl font-bold">Permission Management</h1>
            <a href="{{ route('dashboard') }}" class="btn btn-sm">Back to Dashboard</a>
        </div>

        @if(session('status'))
            <x-alert-success>{{ session('status') }}</x-alert-success>
        @endif

        @if($errors->any())
            <x-alert-error>{{ $errors->first() }}</x-alert-error>
        @endif

        @can('permissions.manage')
            <div class="card bg-base-100 shadow">
                <div class="card-body">
                    <h2 class="card-title">Create Permission</h2>

                    <form method="POST" action="{{ route('dashboard.permissions.store') }}" class="space-y-4">
                        @csrf

                        <div>
                            <label for="name">Permission Name</label>
                            <input id="name" name="name" type="text" class="input input-bordered w-full" required>
                        </div>

                        <button type="submit" class="btn btn-primary btn-sm">Create Permission</button>
                    </form>
                </div>
            </div>
        @endcan

        <div class="card bg-base-100 shadow">
            <div class="card-body">
                <h2 class="card-title">All Permissions</h2>

                <div class="overflow-x-auto">
                    <table class="table table-zebra">
                        <thead>
                        <tr>
                            <th>Name</th>
                            @can('permissions.manage')
                                <th>Actions</th>
                            @endcan
                        </tr>
                        </thead>
                        <tbody>
                        @forelse($permissions as $permission)
                            <tr>
                                <td class="font-semibold">{{ $permission->name }}</td>

                                @can('permissions.manage')
                                    <td class="space-y-2 min-w-[280px]">
                                        <form method="POST" action="{{ route('dashboard.permissions.update', $permission) }}" class="flex items-center gap-2">
                                            @csrf
                                            @method('PUT')

                                            <input
                                                type="text"
                                                name="name"
                                                value="{{ $permission->name }}"
                                                class="input input-bordered input-sm w-full"
                                                required
                                            >

                                            <button type="submit" class="btn btn-info btn-xs">Update</button>
                                        </form>

                                        <form method="POST" action="{{ route('dashboard.permissions.destroy', $permission) }}">
                                            @csrf
                                            @method('DELETE')

                                            <button type="submit" class="btn btn-error btn-xs">
                                                Delete
                                            </button>
                                        </form>
                                    </td>
                                @endcan
                            </tr>
                        @empty
                            <tr>
                                <td colspan="{{ auth()->user()->can('permissions.manage') ? 2 : 1 }}" class="text-center">
No permissions found.</td>
                            </tr>
                        @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
</div>
@endsection
