@extends('layouts.app')

@section('title', 'My Profile')

@section('content')
    <div class="max-w-4xl mx-auto p-4 space-y-6">
        <div class="flex items-center justify-between">
            <h1 class="text-2xl font-bold">My Profile</h1>
            <a href="{{ route('dashboard') }}" class="btn btn-sm">Back to Dashboard</a>
        </div>

        <a href="{{ route('dashboard.profile.edit') }}" class="btn btn-sm btn-primary">Edit Profile</a>


        <div class="card bg-base-100 shadow">
            <div class="card-body space-y-2">
                <p><strong>User ID:</strong> {{ $user->userID }}</p>
                <p><strong>Name:</strong> {{ $user->first_name }} {{ $user->last_name }}</p>
                <p><strong>Email:</strong> {{ $user->email }}</p>
                <p><strong>Phone:</strong> {{ $user->phone }}</p>
                <p><strong>Gender:</strong> {{ ucfirst($user->gender) }}</p>
                <p><strong>Address:</strong> {{ $user->address }}</p>
                <p><strong>Roles:</strong> {{ $user->getRoleNames()->implode(', ') ?: 'None' }}</p>
            </div>
        </div>
    </div>
@endsection
