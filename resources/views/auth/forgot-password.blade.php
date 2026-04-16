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
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="size-4">
                            <path
                                d="M3.105 2.288a.75.75 0 0 0-.826.95l1.414 4.926A1.5 1.5 0 0 0 5.135 9.25h6.115a.75.75 0 0 1 0 1.5H5.135a1.5 1.5 0 0 0-1.442 1.086l-1.414 4.926a.75.75 0 0 0 .826.95 28.897 28.897 0 0 0 15.293-7.155.75.75 0 0 0 0-1.114A28.897 28.897 0 0 0 3.105 2.288Z" />
                        </svg>
                        Send Email
                    </button>
                </div>
                <div class="divider my-1">OR</div>
                <div class="flex items-center gap-2">
                    <a href="/register" class="btn flex-1">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="size-4">
                            <path
                                d="M10 5a3 3 0 1 1-6 0 3 3 0 0 1 6 0ZM1.615 16.428a1.224 1.224 0 0 1-.569-1.175 6.002 6.002 0 0 1 11.908 0c.058.467-.172.92-.57 1.174A9.953 9.953 0 0 1 7 18a9.953 9.953 0 0 1-5.385-1.572ZM16.25 5.75a.75.75 0 0 0-1.5 0v2h-2a.75.75 0 0 0 0 1.5h2v2a.75.75 0 0 0 1.5 0v-2h2a.75.75 0 0 0 0-1.5h-2v-2Z" />
                        </svg>
                        Register an account</a>
                    <a href="/login" class="btn">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor"
                             class="size-4 mt-0.5">
                            <path fill-rule="evenodd"
                                  d="M17 4.25A2.25 2.25 0 0 0 14.75 2h-5.5A2.25 2.25 0 0 0 7 4.25v2a.75.75 0 0 0 1.5 0v-2a.75.75 0 0 1 .75-.75h5.5a.75.75 0 0 1 .75.75v11.5a.75.75 0 0 1-.75.75h-5.5a.75.75 0 0 1-.75-.75v-2a.75.75 0 0 0-1.5 0v2A2.25 2.25 0 0 0 9.25 18h5.5A2.25 2.25 0 0 0 17 15.75V4.25Z"
                                  clip-rule="evenodd" />
                            <path fill-rule="evenodd"
                                  d="M1 10a.75.75 0 0 1 .75-.75h9.546l-1.048-.943a.75.75 0 1 1 1.004-1.114l2.5 2.25a.75.75 0 0 1 0 1.114l-2.5 2.25a.75.75 0 1 1-1.004-1.114l1.048-.943H1.75A.75.75 0 0 1 1 10Z"
                                  clip-rule="evenodd" />
                        </svg>
                        Login</a>
                </div>
            </form>
        </div>
    </div>
@endsection

