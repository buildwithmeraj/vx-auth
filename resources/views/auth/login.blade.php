@extends('layouts.app')
@section('title', 'Login')
@section('content')
    <div class="flex h-[82vh] items-center justify-center">
        <div class="card bg-base-300 w-sm shadow-sm">
            <form action="/login" method="post" class="card-body">
                @csrf
                <h2 class="text-center font-bold text-2xl">Login</h2>
                @if ($errors->any())
                    @foreach ($errors->all() as $error)
                        <x-alert-error>{{ $error }}</x-alert-error>
                    @endforeach
                @endif
                @if (session('status'))
                    <x-alert-success>{{ session('status') }}</x-alert-success>
                @endif
                <div>
                    <label for="userid">User ID</label>
                    <input type="text" placeholder="VX123456" name="userid" class="input w-full" id="userid"
                           value="{{ $data['userid'] ?? '' }}" required />
                </div>
                <div>
                    <label for="password">Password</label>
                    <input type="password" placeholder="********" name="password" id="password" class="input w-full" />
                </div>
                <div class="mt-1">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                         stroke="currentColor" class="size-4 inline">
                        <path stroke-linecap="round" stroke-linejoin="round"
                              d="m11.25 11.25.041-.02a.75.75 0 0 1 1.063.852l-.708 2.836a.75.75 0 0 0 1.063.853l.041-.021M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Zm-9-3.75h.008v.008H12V8.25Z" />
                    </svg>
                    Leave blank if you haven't set a password yet
                </div>
                <div class="card-actions justify-end mt-2">
                    <button type="submit" class="btn btn-block">Login</button>
                </div>
                <div class="mt-2 text-center">
                    <a href="/register" class="hover:text-primary">Don't have an account?</a>
                </div>
            </form>
        </div>
    </div>
@endsection

