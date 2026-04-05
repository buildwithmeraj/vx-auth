@extends('layouts.app')
@section('title', 'Reset Password')
@section('content')
    <div class="flex h-[82vh] items-center justify-center">
        <div class="card bg-base-300 w-sm shadow-sm">
            <form action="/reset-password" method="post" class="card-body">
                @csrf
                <h2 class="text-center font-bold text-2xl">Reset Password</h2>
                @if ($errors->any())
                    @foreach ($errors->all() as $error)
                        <x-alert-error>{{ $error }}</x-alert-error>
                    @endforeach
                @endif
                @if (session('status'))
                    <x-alert-success>{{ session('status') }}</x-alert-success>
                @endif
                @if(empty(request('token')))
                    <x-alert-error>Invalid or expired reset token. Please request a new password reset.</x-alert-error>
                    <div class="hover:text-primary text-center mt-2"><a href="/forgot-password">Forgot password page</a>
                    </div>{{request('token')}}
                @else
                    <input type="hidden" name="reset_token" value="{{ request('token') }}" />
                    <div>
                        <label for="password">Password</label>
                        <input type="password" placeholder="********" name="password" class="input w-full" id="password"
                               required />
                    </div>
                    <div>
                        <label for="password_confirmation">Confirm Password</label>
                        <input type="password" placeholder="********" name="password_confirmation"
                               id="password_confirmation"
                               class="input w-full"
                               required />
                    </div>
                    <div class="card-actions justify-end mt-2">
                        <button type="submit" class="btn btn-block">Reset Password</button>
                    </div>
                    <div class="mt-2 text-center">
                        <a href="/login" class="hover:text-primary">Login to your account</a>
                    </div>
                @endif
            </form>
        </div>
    </div>
@endsection

