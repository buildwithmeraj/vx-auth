@extends('layouts.app')
@section('title', 'Dashboard')
@section('content')
    <div class="flex h-[82vh] items-center justify-center">
        <div class="card bg-base-300 w-sm shadow-sm">
            <div class="card-body">
                <h2 class="text-center font-bold text-2xl">Welcome to Dashboard</h2>
                <p class="text-center">You are logged in
                    as {{ auth()->user()->first_name }} {{ auth()->user()->last_name }}</p>
                <p class="text-center">User ID: {{ auth()->user()->userID }}</p>
                <div class="card-actions justify-center mt-4">
                    <form action="/logout" method="post">
                        @csrf
                        <button type="submit" class="btn btn-error">Logout</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
