@extends('layouts.app')
@section('title', 'Reset Password')
@section('content')
    <div class="flex h-[82vh] items-center justify-center">
        <div class="card bg-base-300 w-sm md:w-md shadow-sm">
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
                        <button type="submit" class="btn btn-block btn-primary">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                 stroke="currentColor" class="size-4">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                      d="M11.42 15.17 17.25 21A2.652 2.652 0 0 0 21 17.25l-5.877-5.877M11.42 15.17l2.496-3.03c.317-.384.74-.626 1.208-.766M11.42 15.17l-4.655 5.653a2.548 2.548 0 1 1-3.586-3.586l6.837-5.63m5.108-.233c.55-.164 1.163-.188 1.743-.14a4.5 4.5 0 0 0 4.486-6.336l-3.276 3.277a3.004 3.004 0 0 1-2.25-2.25l3.276-3.276a4.5 4.5 0 0 0-6.336 4.486c.091 1.076-.071 2.264-.904 2.95l-.102.085m-1.745 1.437L5.909 7.5H4.5L2.25 3.75l1.5-1.5L7.5 4.5v1.409l4.26 4.26m-1.745 1.437 1.745-1.437m6.615 8.206L15.75 15.75M4.867 19.125h.008v.008h-.008v-.008Z" />
                            </svg>
                            Reset Password
                        </button>
                    </div>
                    <div class="divider my-1">OR</div>
                    <div class="flex items-center gap-2">
                        <a href="/register" class="btn flex-1">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                 stroke="currentColor" class="size-5 mt-0.5">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                      d="M18 7.5v3m0 0v3m0-3h3m-3 0h-3m-2.25-4.125a3.375 3.375 0 1 1-6.75 0 3.375 3.375 0 0 1 6.75 0ZM3 19.235v-.11a6.375 6.375 0 0 1 12.75 0v.109A12.318 12.318 0 0 1 9.374 21c-2.331 0-4.512-.645-6.374-1.766Z" />
                            </svg>
                            Register an account</a>
                        <a href="/login" class="btn">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                 stroke="currentColor" class="size-5">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                      d="M8.25 9V5.25A2.25 2.25 0 0 1 10.5 3h6a2.25 2.25 0 0 1 2.25 2.25v13.5A2.25 2.25 0 0 1 16.5 21h-6a2.25 2.25 0 0 1-2.25-2.25V15M12 9l3 3m0 0-3 3m3-3H2.25" />
                            </svg>
                            Login</a>
                    </div>
                @endif
            </form>
        </div>
    </div>
@endsection

