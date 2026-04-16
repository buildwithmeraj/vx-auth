@extends('layouts.app')

@section('title', 'Edit Profile')

@section('content')
    <div class="max-w-4xl mx-auto p-4 space-y-6">
        <div class="flex items-center justify-between">
            <h1 class="text-2xl font-bold">Edit Profile</h1>
            <a href="{{ route('dashboard.profile.show') }}" class="btn btn-sm btn-primary">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="size-5">
                    <path fill-rule="evenodd"
                          d="M17 10a.75.75 0 0 1-.75.75H5.612l4.158 3.96a.75.75 0 1 1-1.04 1.08l-5.5-5.25a.75.75 0 0 1 0-1.08l5.5-5.25a.75.75 0 1 1 1.04 1.08L5.612 9.25H16.25A.75.75 0 0 1 17 10Z"
                          clip-rule="evenodd" />
                </svg>
                Back to Profile</a>
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

                    <div class="flex items-center gap-2 mb-1">
                        <label for="photo">Photo</label>
                        <div class="tooltip tooltip-right relative">
                            <div class="tooltip-content z-[400]">Upload your photo to imgbb and paste the direct
                                image
                                URL
                                here.
                            </div>
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor"
                                 class="size-4">
                                <path fill-rule="evenodd"
                                      d="M18 10a8 8 0 1 1-16 0 8 8 0 0 1 16 0ZM8.94 6.94a.75.75 0 1 1-1.061-1.061 3 3 0 1 1 2.871 5.026v.345a.75.75 0 0 1-1.5 0v-.5c0-.72.57-1.172 1.081-1.287A1.5 1.5 0 1 0 8.94 6.94ZM10 15a1 1 0 1 0 0-2 1 1 0 0 0 0 2Z"
                                      clip-rule="evenodd" />
                            </svg>
                        </div>
                    </div>

                    <div class="flex items-center gap-2">
                        <input
                            id="photo"
                            name="photo"
                            type="url"
                            class="input input-bordered w-full flex-1"
                            value="{{ old('photo', $user->photo) }}"
                            required
                        >
                        <a href="https://imgbb.com" target="_blank" class="btn">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor"
                                 class="size-4">
                                <path fill-rule="evenodd"
                                      d="M4.25 5.5a.75.75 0 0 0-.75.75v8.5c0 .414.336.75.75.75h8.5a.75.75 0 0 0 .75-.75v-4a.75.75 0 0 1 1.5 0v4A2.25 2.25 0 0 1 12.75 17h-8.5A2.25 2.25 0 0 1 2 14.75v-8.5A2.25 2.25 0 0 1 4.25 4h5a.75.75 0 0 1 0 1.5h-5Z"
                                      clip-rule="evenodd" />
                                <path fill-rule="evenodd"
                                      d="M6.194 12.753a.75.75 0 0 0 1.06.053L16.5 4.44v2.81a.75.75 0 0 0 1.5 0v-4.5a.75.75 0 0 0-.75-.75h-4.5a.75.75 0 0 0 0 1.5h2.553l-9.056 8.194a.75.75 0 0 0-.053 1.06Z"
                                      clip-rule="evenodd" />
                            </svg>
                            Upload</a>
                    </div>


                    <div class="flex justify-end gap-2 mt-4">
                        <a href="{{ route('dashboard.profile.show') }}" class="btn">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor"
                                 class="size-5">
                                <path fill-rule="evenodd"
                                      d="M10 18a8 8 0 1 0 0-16 8 8 0 0 0 0 16ZM8.28 7.22a.75.75 0 0 0-1.06 1.06L8.94 10l-1.72 1.72a.75.75 0 1 0 1.06 1.06L10 11.06l1.72 1.72a.75.75 0 1 0 1.06-1.06L11.06 10l1.72-1.72a.75.75 0 0 0-1.06-1.06L10 8.94 8.28 7.22Z"
                                      clip-rule="evenodd" />
                            </svg>
                            Cancel</a>
                        <button type="submit" class="btn btn-primary">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor"
                                 class="size-5">
                                <path fill-rule="evenodd"
                                      d="M16.704 4.153a.75.75 0 0 1 .143 1.052l-8 10.5a.75.75 0 0 1-1.127.075l-4.5-4.5a.75.75 0 0 1 1.06-1.06l3.894 3.893 7.48-9.817a.75.75 0 0 1 1.05-.143Z"
                                      clip-rule="evenodd" />
                            </svg>
                            Save Changes
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
