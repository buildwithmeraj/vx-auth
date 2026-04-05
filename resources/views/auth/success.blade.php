@extends('layouts.app')
@section('title', 'Registration Successful')
@section('content')
    <div class="flex h-[82vh] items-center justify-center">
        <div class="card bg-base-300 w-sm shadow-sm">
            <div class="card-body">
                <h2 class="text-center font-bold text-2xl">Register</h2>
                <p class="text-success font-semibold p-4 text-center">Registration was successful! Please check your
                    inbox
                    for instructions about next
                    steps.</p>
                <div class="card-actions justify-end mt-2">
                    <a href="/login" class="btn btn-block">Login</a>
                </div>
            </div>
        </div>
@endsection
