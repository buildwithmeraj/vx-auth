@extends('layouts.app')

@section('title', 'Edit Profile')

@section('content')
    <div class="max-w-4xl mx-auto p-4 space-y-6">
        <div class="flex items-center justify-between">
            <h1 class="text-2xl font-bold">Edit Profile</h1>
            <a href="{{ route('dashboard.profile.show') }}" class="btn btn-sm">Back to Profile</a>
        </div>

        @if($errors->any())
            <x-alert-error>{{ $errors->first() }}</x-alert-error>
        @endif

        <div class="card bg-base-100 shadow">
            <div class="card-body">
                <form method="POST" action="{{ route('dashboard.profile.update') }}" class="space-y-4">
                    @csrf
                    @method('PUT')

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label for="first_name">First Name</label>
                            <input
                                id="first_name"
                                name="first_name"
                                type="text"
                                class="input input-bordered w-full"
                                value="{{ old('first_name', $user->first_name) }}"
                                required
                            >
                        </div>

                        <div>
                            <label for="last_name">Last Name</label>
                            <input
                                id="last_name"
                                name="last_name"
                                type="text"
                                class="input input-bordered w-full"
                                value="{{ old('last_name', $user->last_name) }}"
                                required
                            >
                        </div>
                    </div>

                    <div>
                        <label for="phone">Phone</label>
                        <input
                            id="phone"
                            name="phone"
                            type="text"
                            class="input input-bordered w-full"
                            value="{{ old('phone', $user->phone) }}"
                            required
                        >
                    </div>

                    <div>
                        <label for="gender">Gender</label>
                        <select id="gender" name="gender" class="select select-bordered w-full" required>
                            <option value="male" @selected(old('gender', $user->gender) === 'male')>Male</option>
                            <option value="female" @selected(old('gender', $user->gender) === 'female')>Female</option>
                            <option value="other" @selected(old('gender', $user->gender) === 'other')>Other</option>
                        </select>
                    </div>

                    <div>
                        <label for="address">Address</label>
                        <textarea
                            id="address"
                            name="address"
                            class="textarea textarea-bordered w-full"
                            rows="3"
                            required
                        >{{ old('address', $user->address) }}</textarea>
                    </div>

                    <div>
                        <label for="photo">Photo URL</label>
                        <input
                            id="photo"
                            name="photo"
                            type="url"
                            class="input input-bordered w-full"
                            value="{{ old('photo', $user->photo) }}"
                            required
                        >
                    </div>

                    <div class="flex justify-end gap-2">
                        <a href="{{ route('dashboard.profile.show') }}" class="btn btn-ghost btn-sm">Cancel</a>
                        <button type="submit" class="btn btn-primary btn-sm">Save Changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
