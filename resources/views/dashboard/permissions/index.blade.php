@extends('layouts.app')

@section('title', 'Permission Management')

@section('content')
    <div class="max-w-4xl mx-auto p-4 space-y-6">
        <div class="flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
            <div>
                <h2 class="text-2xl font-bold">Permission Management</h2>
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

        @can('permissions.manage')
    <div class="card bg-base-100 border border-base-300 shadow">
        <div class="card-body">
            <h2 class="card-title text-base">Create New Permission</h2>

            <form method="POST" action="{{ route('dashboard.permissions.store') }}" class="space-y-2">
                @csrf
                <div class="flex flex-col gap-2 sm:flex-row sm:items-center">
                    <input
                        id="name"
                        name="name"
                        type="text"
                        class="input input-bordered w-full"
                        value="{{ old('name') }}"
                        placeholder="Permission Name"
                        required
                    >

                    <button type="submit" class="btn btn-primary btn-sm gap-1 sm:shrink-0">
                        <svg xmlns="http://www.w3.org/2000/svg" class="size-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M12 4.5v15m7.5-7.5h-15"/>
                        </svg>
                        Create
                    </button>
                </div>
            </form>
        </div>
    </div>
@endcan


        <div>
            <h2 class="text-lg font-semibold">All Permissions ({{ $permissions->count() }})</h2>
        </div>

        <div class="card bg-base-100 shadow">
            <div class="card-body p-0">
                <div class="hidden md:block overflow-x-auto">
                    <table class="table">
                        <thead>
                        <tr>
                            <th class="w-[35%]">Permission Name</th>
                            @can('permissions.manage')
                                <th>Actions</th>
                            @endcan
                        </tr>
                        </thead>
                        <tbody>
                        @forelse($permissions as $permission)
                            <tr>
                                <td class="font-medium align-top">
                                    {{ $permission->name }}
                                </td>

                                @can('permissions.manage')
                                    <td>
                                        <div class="flex flex-col gap-2 xl:flex-row xl:items-center">
                                            <form method="POST" action="{{ route('dashboard.permissions.update', $permission) }}" class="flex w-full flex-col gap-2 lg:flex-row lg:items-center">
                                                @csrf
                                                @method('PUT')

                                                <input
                                                    type="text"
                                                    name="name"
                                                    value="{{ $permission->name }}"
                                                    class="input input-bordered input-sm w-full"
                                                    required
                                                >

                                                <button type="submit" class="btn btn-info btn-xs gap-1 whitespace-nowrap">
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="size-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M16.862 4.487a2.1 2.1 0 1 1 2.97 2.97L8.25 19.04 4.5 19.5l.46-3.75 11.902-11.263Z"/>
                                                    </svg>
                                                    Update
                                                </button>
                                            </form>

                                            <form method="POST" action="{{ route('dashboard.permissions.destroy', $permission) }}">
                                                @csrf
                                                @method('DELETE')

                                                <button type="submit" class="btn btn-error btn-xs gap-1 whitespace-nowrap">
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="size-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916A2.25 2.25 0 0 0 13.5 2.25h-3a2.25 2.25 0 0 0-2.25 2.25v.916m7.5 0h-7.5"/>
                                                    </svg>
                                                    Delete
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                @endcan
                            </tr>
                        @empty
                            <tr>
                                <td colspan="{{ auth()->user()->can('permissions.manage') ? 2 : 1 }}" class="text-center py-6">
                                    No permissions found.
                                </td>
                            </tr>
                        @endforelse
                        </tbody>
                    </table>
                </div>

                <div class="md:hidden p-4 space-y-3">
                    @forelse($permissions as $permission)
                        <div class="rounded-box border border-base-300 p-3 space-y-3">
                            <div class="font-medium break-all">{{ $permission->name }}</div>

                            @can('permissions.manage')
                                <form method="POST" action="{{ route('dashboard.permissions.update', $permission) }}" class="space-y-2">
                                    @csrf
                                    @method('PUT')

                                    <input
                                        type="text"
                                        name="name"
                                        value="{{ $permission->name }}"
                                        class="input input-bordered input-sm w-full"
                                        required
                                    >

                                    <button type="submit" class="btn btn-info btn-xs w-full gap-1">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="size-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M16.862 4.487a2.1 2.1 0 1 1 2.97 2.97L8.25 19.04 4.5 19.5l.46-3.75 11.902-11.263Z"/>
                                        </svg>
                                        Update
                                    </button>
                                </form>

                                <form method="POST" action="{{ route('dashboard.permissions.destroy', $permission) }}">
                                    @csrf
                                    @method('DELETE')

                                    <button type="submit" class="btn btn-error btn-xs w-full gap-1">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="size-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916A2.25 2.25 0 0 0 13.5 2.25h-3a2.25 2.25 0 0 0-2.25 2.25v.916m7.5 0h-7.5"/>
                                        </svg>
                                        Delete
                                    </button>
                                </form>
                            @endcan
                        </div>
                    @empty
                        <div class="text-center py-6 opacity-70">No permissions found.</div>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
@endsection
