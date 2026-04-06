@extends('layouts.app')
@section('title', 'Admin Dashboard')
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
                    <button type="submit" class="btn btn-error btn-sm text-white">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                             stroke="currentColor" class="size-4">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                  d="M8.25 9V5.25A2.25 2.25 0 0 1 10.5 3h6a2.25 2.25 0 0 1 2.25 2.25v13.5A2.25 2.25 0 0 1 16.5 21h-6a2.25 2.25 0 0 1-2.25-2.25V15m-3 0-3-3m0 0 3-3m-3 3H15" />
                        </svg>
                        Logout
                    </button>
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
                            <div class="badge badge-success">{{ ucfirst($user->role) }}</div>
                            <div class="badge badge-ghost mt-2">ID: {{ $user->userID }}</div>
                        </div>
                        <h2 class="font-semibold text-center mt-4">Profile Details</h2>
                        <div class="divider my-1"></div>
                        <div class="mt-2 grid grid-cols-1 gap-3 text-sm">
                            <div class="flex justify-between items-center">
                                <div class="text-sm">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                         stroke-width="1.5" stroke="currentColor" class="size-4 inline mb-0.5">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                              d="M2.25 6.75c0 8.284 6.716 15 15 15h2.25a2.25 2.25 0 0 0 2.25-2.25v-1.372c0-.516-.351-.966-.852-1.091l-4.423-1.106c-.44-.11-.902.055-1.173.417l-.97 1.293c-.282.376-.769.542-1.21.38a12.035 12.035 0 0 1-7.143-7.143c-.162-.441.004-.928.38-1.21l1.293-.97c.363-.271.527-.734.417-1.173L6.963 3.102a1.125 1.125 0 0 0-1.091-.852H4.5A2.25 2.25 0 0 0 2.25 4.5v2.25Z" />
                                    </svg>
                                    Phone
                                </div>
                                <div class="">{{ $user->phone }}</div>
                            </div>
                            <div class="flex justify-between items-center">
                                <div class="text-sm">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                         stroke-width="1.5" stroke="currentColor" class="size-4 inline mb-0.5">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                              d="M15.75 6a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0ZM4.501 20.118a7.5 7.5 0 0 1 14.998 0A17.933 17.933 0 0 1 12 21.75c-2.676 0-5.216-.584-7.499-1.632Z" />
                                    </svg>
                                    Gender
                                </div>
                                <div class="">{{ ucfirst($user->gender) }}</div>
                            </div>
                            <div class="flex justify-between items-center">
                                <div class="text-sm">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                         stroke-width="1.5" stroke="currentColor" class="size-4 inline mb-0.5">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                              d="M21.75 6.75v10.5a2.25 2.25 0 0 1-2.25 2.25h-15a2.25 2.25 0 0 1-2.25-2.25V6.75m19.5 0A2.25 2.25 0 0 0 19.5 4.5h-15a2.25 2.25 0 0 0-2.25 2.25m19.5 0v.243a2.25 2.25 0 0 1-1.07 1.916l-7.5 4.615a2.25 2.25 0 0 1-2.36 0L3.32 8.91a2.25 2.25 0 0 1-1.07-1.916V6.75" />
                                    </svg>
                                    Email
                                </div>
                                <div class="">{{ $user->email }}</div>
                            </div>
                            <div class="flex justify-between items-center">
                                <div class="text-sm">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                         stroke-width="1.5" stroke="currentColor" class="size-4 inline mb-0.5">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                              d="M15 10.5a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                              d="M19.5 10.5c0 7.142-7.5 11.25-7.5 11.25S4.5 17.642 4.5 10.5a7.5 7.5 0 1 1 15 0Z" />
                                    </svg>
                                    Address
                                </div>
                                <div class="">{{ $user->address }}</div>
                            </div>
                            <div class="flex items-center justify-between gap-3">
                                <span class="text-base-content/70"><svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                                                        viewBox="0 0 24 24" stroke-width="1.5"
                                                                        stroke="currentColor"
                                                                        class="size-4 inline mb-0.5">
  <path stroke-linecap="round" stroke-linejoin="round"
        d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 0 1 2.25-2.25h13.5A2.25 2.25 0 0 1 21 7.5v11.25m-18 0A2.25 2.25 0 0 0 5.25 21h13.5A2.25 2.25 0 0 0 21 18.75m-18 0v-7.5A2.25 2.25 0 0 1 5.25 9h13.5A2.25 2.25 0 0 1 21 11.25v7.5m-9-6h.008v.008H12v-.008ZM12 15h.008v.008H12V15Zm0 2.25h.008v.008H12v-.008ZM9.75 15h.008v.008H9.75V15Zm0 2.25h.008v.008H9.75v-.008ZM7.5 15h.008v.008H7.5V15Zm0 2.25h.008v.008H7.5v-.008Zm6.75-4.5h.008v.008h-.008v-.008Zm0 2.25h.008v.008h-.008V15Zm0 2.25h.008v.008h-.008v-.008Zm2.25-4.5h.008v.008H16.5v-.008Zm0 2.25h.008v.008H16.5V15Z" />
</svg>
User since</span>
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
                                <table class="table w-full">
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
                                            <td>{{ ucfirst($user->gender) }}</td>
                                            <td>{{ ucfirst($user->role) }}</td>
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
