@extends('layouts.app')
@section('title', 'Forgot Password')
@section('content')
    <div class="flex h-[82vh] items-center justify-center">
        <div class="card bg-base-300 w-sm md:w-md shadow-sm">
            <form action="/forgot-password" method="post" class="card-body">
                @csrf
                <h2 class="text-center font-bold text-2xl">Forgot Password</h2>
                @if ($errors->any())
                    @foreach ($errors->all() as $error)
                        <x-alert-error>{{ $error }}</x-alert-error>
                    @endforeach
                @endif
                @if (session('status'))
                    <x-alert-success>{{ session('status') }}</x-alert-success>
                @endif
                <div>
                    <label for="email">Email</label>
                    <input type="email" placeholder="email@domain.com" name="email" class="input w-full" id="email"
                           required />
                </div>
                <div class="card-actions justify-end mt-2">
                    <button type="submit" class="btn btn-block btn-primary">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                             stroke="currentColor" class="size-4">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                  d="M6 12 3.269 3.125A59.769 59.769 0 0 1 21.485 12 59.768 59.768 0 0 1 3.27 20.875L5.999 12Zm0 0h7.5" />
                        </svg>
                        Send Email
                    </button>
                </div>
                <div class="divider my-1">OR</div>
                <div class="flex items-center gap-2">
                    <a href="/register" class="btn flex-1">Register an account</a>
                    <a href="/login" class="btn flex-1">Login to your account</a>
                </div>
            </form>
        </div>
    </div>
@endsection

