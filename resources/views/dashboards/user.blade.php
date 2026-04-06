@extends('layouts.app')
@section('title', 'Dashboard')
@section('content')
    @php($user = auth()->user())

    <div class="min-h-[82vh] px-4 py-4">
        <div class="mx-auto w-full max-w-4xl">
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
                    <div class="card-body items-center text-center">
                        <div class="avatar">
                            <div class="w-24 rounded-full ring ring-primary/30 ring-offset-2 ring-offset-base-100">
                                <img src="{{ $user->photo }}" alt="{{ $user->first_name }} {{ $user->last_name }}" />
                            </div>
                        </div>
                        <div class="mt-2 flex flex-col items-center justify-center gap-2">
                            <div class="text-xl font-bold">{{ $user->first_name }} {{ $user->last_name }}</div>
                            <div class="badge badge-primary badge-outline">{{ $user->role }}</div>
                            <div class="badge badge-ghost">ID: {{ $user->userID }}</div>
                        </div>

                        <div class="mt-2 w-full">
                            <div class="divider my-3">Aditional Info</div>
                            <div class="space-y-2 text-left text-sm">
                                <div class="flex items-center justify-between gap-3">
                                    <span class="text-base-content/70">User since</span>
                                    <span class="font-medium">{{ $user->created_at?->format('M d, Y') }}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card bg-base-300 shadow-sm md:col-span-2">
                    <div class="card-body">
                        <h2 class="card-title">Profile Details</h2>
                        <div class="mt-2 grid grid-cols-1 gap-3 sm:grid-cols-2">
                            <div class="rounded-box bg-base-200 p-4">
                                <div class="text-sm text-base-content/70">Phone</div>
                                <div class="mt-1 font-medium">{{ $user->phone }}</div>
                            </div>
                            <div class="rounded-box bg-base-200 p-4">
                                <div class="text-sm text-base-content/70">Gender</div>
                                <div class="mt-1 font-medium">{{ $user->gender }}</div>
                            </div>
                            <div class="rounded-box bg-base-200 p-4 sm:col-span-2">
                                <div class="text-sm text-base-content/70">Email</div>
                                <div class="mt-1 font-medium">{{ $user->email }}</div>
                            </div>
                            <div class="rounded-box bg-base-200 p-4 sm:col-span-2">
                                <div class="text-sm text-base-content/70">Address</div>
                                <div class="mt-1 font-medium">{{ $user->address }}</div>
                            </div>
                        </div>

                        @if (session('status'))
                            <div class="mt-4">
                                <x-alert-success>{{ session('status') }}</x-alert-success>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
