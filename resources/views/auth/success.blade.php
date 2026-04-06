@extends('layouts.app')
@section('title', 'Registration Successful')
@section('content')
    <div class="flex h-[82vh] items-center justify-center">
        <div class="card bg-base-300 w-sm shadow-sm">
            <div class="card-body">
                <h2 class="text-center font-bold text-2xl">Register</h2>
                <x-alert-success>Registration was successful! Please check your inbox for instructions about next
                    steps
                </x-alert-success>
                <h2 class="text-center font-bold text-xl mt-2">Important!</h2>
                <p class="p-2 text-sm opacity-70">You will get an unique User ID in your email inbox. Use that to login
                    (without password).
                    Then you will be
                    asked to reset
                    (set) the password. Do change the password as soon as possible. After that, you will be able to
                    login with the User ID and the password you set.</p>
                <div class="card-actions">
                    <a href="/login" class="btn btn-block btn-primary">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                             stroke="currentColor" class="size-5">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                  d="M8.25 9V5.25A2.25 2.25 0 0 1 10.5 3h6a2.25 2.25 0 0 1 2.25 2.25v13.5A2.25 2.25 0 0 1 16.5 21h-6a2.25 2.25 0 0 1-2.25-2.25V15M12 9l3 3m0 0-3 3m3-3H2.25" />
                        </svg>
                        Login</a>
                </div>
            </div>
        </div>
@endsection
