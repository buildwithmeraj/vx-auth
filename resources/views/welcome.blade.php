@extends('layouts.app')

@section('title', 'Welcome')

@section('content')
    <section class="max-w-7xl mx-auto px-4 py-10 md:py-16 space-y-10">
        <div class="hero bg-base-200 rounded-box border border-base-300">
            <div class="hero-content text-center py-14">
                <div class="max-w-2xl">
                    <h2 class="text-3xl font-bold uppercase">VX Auth</h2>
                    <h3 class="text-xl font-bold mt-2 opacity-60">Modern Auth + RBAC Starter</h3>
                    <p class="py-4 opacity-80">
                        A clean Laravel authentication system with role-permission management,
                        profile pages, and a responsive dashboard.
                    </p>

                    <div class="flex flex-col sm:flex-row gap-3 justify-center">
                        @auth
                            <a href="{{ route('dashboard') }}" class="btn btn-primary">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor"
                                     class="size-5">
                                    <path fill-rule="evenodd"
                                          d="M2 4.25A2.25 2.25 0 0 1 4.25 2h11.5A2.25 2.25 0 0 1 18 4.25v8.5A2.25 2.25 0 0 1 15.75 15h-3.105a3.501 3.501 0 0 0 1.1 1.677A.75.75 0 0 1 13.26 18H6.74a.75.75 0 0 1-.484-1.323A3.501 3.501 0 0 0 7.355 15H4.25A2.25 2.25 0 0 1 2 12.75v-8.5Zm1.5 0a.75.75 0 0 1 .75-.75h11.5a.75.75 0 0 1 .75.75v7.5a.75.75 0 0 1-.75.75H4.25a.75.75 0 0 1-.75-.75v-7.5Z"
                                          clip-rule="evenodd" />
                                </svg>
                                Go to Dashboard</a>
                            <a href="{{ route('dashboard.profile.show') }}" class="btn btn-info text-white">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor"
                                     class="size-5">
                                    <path fill-rule="evenodd"
                                          d="M18 10a8 8 0 1 1-16 0 8 8 0 0 1 16 0Zm-5.5-2.5a2.5 2.5 0 1 1-5 0 2.5 2.5 0 0 1 5 0ZM10 12a5.99 5.99 0 0 0-4.793 2.39A6.483 6.483 0 0 0 10 16.5a6.483 6.483 0 0 0 4.793-2.11A5.99 5.99 0 0 0 10 12Z"
                                          clip-rule="evenodd" />
                                </svg>
                                View Profile</a>
                        @else
                            <a href="{{ route('login') }}" class="btn btn-primary">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor"
                                     class="size-4 mt-0.5">
                                    <path fill-rule="evenodd"
                                          d="M17 4.25A2.25 2.25 0 0 0 14.75 2h-5.5A2.25 2.25 0 0 0 7 4.25v2a.75.75 0 0 0 1.5 0v-2a.75.75 0 0 1 .75-.75h5.5a.75.75 0 0 1 .75.75v11.5a.75.75 0 0 1-.75.75h-5.5a.75.75 0 0 1-.75-.75v-2a.75.75 0 0 0-1.5 0v2A2.25 2.25 0 0 0 9.25 18h5.5A2.25 2.25 0 0 0 17 15.75V4.25Z"
                                          clip-rule="evenodd" />
                                    <path fill-rule="evenodd"
                                          d="M1 10a.75.75 0 0 1 .75-.75h9.546l-1.048-.943a.75.75 0 1 1 1.004-1.114l2.5 2.25a.75.75 0 0 1 0 1.114l-2.5 2.25a.75.75 0 1 1-1.004-1.114l1.048-.943H1.75A.75.75 0 0 1 1 10Z"
                                          clip-rule="evenodd" />
                                </svg>
                                Login</a>
                            <a href="{{ route('register') }}" class="btn btn-info text-white">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor"
                                     class="size-4 mt-0.5">
                                    <path
                                        d="M10 5a3 3 0 1 1-6 0 3 3 0 0 1 6 0ZM1.615 16.428a1.224 1.224 0 0 1-.569-1.175 6.002 6.002 0 0 1 11.908 0c.058.467-.172.92-.57 1.174A9.953 9.953 0 0 1 7 18a9.953 9.953 0 0 1-5.385-1.572ZM16.25 5.75a.75.75 0 0 0-1.5 0v2h-2a.75.75 0 0 0 0 1.5h2v2a.75.75 0 0 0 1.5 0v-2h2a.75.75 0 0 0 0-1.5h-2v-2Z" />
                                </svg>
                                Create Account</a>
                        @endauth
                    </div>
                </div>
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
            <div class="card bg-base-100 border border-base-300 shadow-sm">
                <div class="card-body">
                    <h2 class="card-title">Role Based Access</h2>
                    <p class="text-sm opacity-80">Built with Spatie permissions and middleware-protected routes.</p>
                </div>
            </div>

            <div class="card bg-base-100 border border-base-300 shadow-sm">
                <div class="card-body">
                    <h2 class="card-title">Unified Dashboard</h2>
                    <p class="text-sm opacity-80">Single dashboard shell with sidebar menus based on user rights.</p>
                </div>
            </div>

            <div class="card bg-base-100 border border-base-300 shadow-sm">
                <div class="card-body">
                    <h2 class="card-title">Profile & Theme</h2>
                    <p class="text-sm opacity-80">User profile view/edit and a persistent dark/light theme toggle.</p>
                </div>
            </div>
        </div>
    </section>
@endsection
