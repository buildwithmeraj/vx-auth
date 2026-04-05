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
                <div>
                    <label for="user">User ID</label>
                    <input type="text" placeholder="VX123456" name="user" class="input w-full"
                           value="{{ $data['user'] ?? '' }}" required />
                </div>
                <div>
                    <label for="password">Password</label>
                    <input type="password" placeholder="********" name="password" class="input w-full"
                           value="{{ $data['last_name'] ?? '' }}" required />
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

