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
                        <a href="/register" class="btn">Register an account</a>
                        <a href="/login" class="btn flex-1">Login to your account</a>
                    </div>
                @endif
            </form>
        </div>
    </div>
@endsection

