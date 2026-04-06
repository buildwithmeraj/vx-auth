@extends('layouts.app')
@section('title', 'Dashboard')
@section('content')
    @php($user = auth()->user())

    <div class="min-h-[82vh] px-4 py-4">
        <div class="mx-auto w-full max-w-7xl">
            <div class="flex items-start justify-between gap-4">
                <div>
                    <h1 class="text-2xl font-bold leading-tight">Dashboard</h1>
                </div>
                <form action="/logout" method="post">
                    @csrf
                    <button type="submit" class="btn btn-error btn-sm">Logout</button>
                </form>
            </div>

            <div class="mt-6 grid grid-cols-1 gap-4 md:grid-cols-3">
                <div class="card bg-base-300 shadow-sm md:col-span-1">
                    <div class="p-6 items-center text-center">
                        <div class="avatar">
                            <div class="w-36 rounded-full ring ring-primary/30 ring-offset-2 ring-offset-base-100">
                                <img src="{{ $user->photo }}" alt="{{ $user->first_name }} {{ $user->last_name }}" />
                            </div>
                        </div>
                        <div class="mt-2 flex flex-col items-center justify-center gap-2">
                            <div class="text-xl font-bold">{{ $user->first_name }} {{ $user->last_name }}</div>
                            <div class="badge badge-primary badge-outline">{{ $user->role }}</div>
                            <div class="badge badge-ghost mt-2">ID: {{ $user->userID }}</div>
                        </div>
                        <h2 class="font-semibold text-center mt-4">Profile Details</h2>
                        <div class="divider my-1"></div>
                        <div class="mt-2 grid grid-cols-1 gap-3 text-sm">
                            <div class="flex justify-between items-center">
                                <div class="text-sm">Phone</div>
                                <div class="">{{ $user->phone }}</div>
                            </div>
                            <div class="flex justify-between items-center">
                                <div class="text-sm">Gender</div>
                                <div class="">{{ $user->gender }}</div>
                            </div>
                            <div class="flex justify-between items-center">
                                <div class="text-sm">Email</div>
                                <div class="">{{ $user->email }}</div>
                            </div>
                            <div class="flex justify-between items-center">
                                <div class="text-sm">Address</div>
                                <div class="">{{ $user->address }}</div>
                            </div>
                            <div class="flex items-center justify-between gap-3">
                                <span class="text-base-content/70">User since</span>
                                <span class="font-medium">{{ $user->created_at?->format('M d, Y') }}</span>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card bg-base-300 shadow-sm md:col-span-2">
                    <div class="card-body">
                        <h2 class="font-semibold text-xl text-center">All Users</h2>
                        @if (session('status'))
                            <div class="mt-4">
                                <x-alert-success>{{ session('status') }}</x-alert-success>
                            </div>
                        @endif
                        @if($users->isEmpty())
                            <div class="mt-4 text-center text-sm opacity-50">No users found.</div>
                        @else
                            <div class="overflow-auto mt-4">
                                <table class="table table-zebra w-full">
                                    <thead>
                                    <tr>
                                        <th>User ID</th>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Phone</th>
                                        <th>Gender</th>
                                        <th>Role</th>
                                        <th>Joined</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($users as $u)
                                        <tr>
                                            <td>{{ $user->userID }}</td>
                                            <td>{{ $user->first_name }} {{ $user->last_name }}</td>
                                            <td>{{ $user->email }}</td>
                                            <td>{{ $user->phone }}</td>
                                            <td>{{ $user->gender }}</td>
                                            <td>{{ $user->role }}</td>
                                            <td>{{ $user->created_at?->format('M d, Y') }}</td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
@endsection
