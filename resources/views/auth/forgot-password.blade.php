@extends('layouts.app')
@section('title', 'Forgot Password')
@section('content')
    <div class="flex h-[82vh] items-center justify-center">
        <div class="card bg-base-300 w-sm shadow-sm">
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
                    <button type="submit" class="btn btn-block">Send Email</button>
                </div>
                <div class="mt-2 text-center">
                    <a href="/login" class="hover:text-primary">Login to your account</a>
                </div>
            </form>
        </div>
    </div>
@endsection

