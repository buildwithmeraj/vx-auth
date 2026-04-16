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
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor"
                                 class="size-4">
                                <path fill-rule="evenodd"
                                      d="M14.5 10a4.5 4.5 0 0 0 4.284-5.882c-.105-.324-.51-.391-.752-.15L15.34 6.66a.454.454 0 0 1-.493.11 3.01 3.01 0 0 1-1.618-1.616.455.455 0 0 1 .11-.494l2.694-2.692c.24-.241.174-.647-.15-.752a4.5 4.5 0 0 0-5.873 4.575c.055.873-.128 1.808-.8 2.368l-7.23 6.024a2.724 2.724 0 1 0 3.837 3.837l6.024-7.23c.56-.672 1.495-.855 2.368-.8.096.007.193.01.291.01ZM5 16a1 1 0 1 1-2 0 1 1 0 0 1 2 0Z"
                                      clip-rule="evenodd" />
                                <path
                                    d="M14.5 11.5c.173 0 .345-.007.514-.022l3.754 3.754a2.5 2.5 0 0 1-3.536 3.536l-4.41-4.41 2.172-2.607c.052-.063.147-.138.342-.196.202-.06.469-.087.777-.067.128.008.257.012.387.012ZM6 4.586l2.33 2.33a.452.452 0 0 1-.08.09L6.8 8.214 4.586 6H3.309a.5.5 0 0 1-.447-.276l-1.7-3.402a.5.5 0 0 1 .093-.577l.49-.49a.5.5 0 0 1 .577-.094l3.402 1.7A.5.5 0 0 1 6 3.31v1.277Z" />
                            </svg>
                            Reset Password
                        </button>
                    </div>
                    <div class="divider my-1">OR</div>
                    <div class="flex items-center gap-2">
                        <a href="/register" class="btn flex-1">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor"
                                 class="size-4 mt-0.5">
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
                @endif
            </form>
        </div>
    </div>
@endsection

