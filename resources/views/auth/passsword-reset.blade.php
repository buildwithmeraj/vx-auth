@extends('layouts.app')
@section('title', 'Reset Password')
@section('content')
    <div class="flex h-[82vh] items-center justify-center">
        <div class="card bg-base-300 w-sm shadow-sm">
            <form action="/login" method="post" class="card-body">
                @csrf
                <h2 class="text-center font-bold text-2xl">Reset Password</h2>
                @if ($errors->any())
                    @foreach ($errors->all() as $error)
                        <x-alert-error>{{ $error }}</x-alert-error>
                    @endforeach
                @endif
                <input type="hidden" name="reset_token" value="{{ $data['reset_token'] ?? '' }}" />
                <div>
                    <label for="password">Password</label>
                    <input type="password" placeholder="********" name="password" class="input w-full"
                           value="{{ $data['last_name'] ?? '' }}" required />
                </div>
                <div>
                    <label for="confirm_password">Confirm Password</label>
                    <input type="password" placeholder="********" name="confirm_password" class="input w-full"
                           value="{{ $data['confirm_password'] ?? '' }}" required />
                </div>
                <div class="card-actions justify-end mt-2">
                    <button type="submit" class="btn btn-block">Reset Password</button>
                </div>
                <div class="mt-2 text-center">
                    <a href="/login" class="hover:text-primary">Login to your account</a>
                </div>
            </form>
        </div>
    </div>
@endsection

