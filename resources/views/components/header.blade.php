@php
    $isDashboardArea = auth()->check() && (request()->routeIs('home') || request()->routeIs('dashboard*'));
@endphp

<div class="navbar bg-base-100 shadow-sm px-3 md:px-5 lg:px-10">
    <div class="flex-1 flex items-center gap-2">
        @if($isDashboardArea)
            <label for="dashboard-drawer" class="cursor-pointer drawer-trigger lg:hidden">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                     stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                </svg>
            </label>
        @endif

        <a class="font-bold text-2xl" href="/">Vixlo</a>
    </div>
    <div class="flex-none flex items-center gap-2">

        @if(auth()->check())
            <img src="{{ auth()->user()->photo }}" alt="Profile Picture" class="w-10 h-10 rounded-full inline mr-2" />
            <a href="/dashboard" class="hover:text-primary mr-2">Dashboard</a>
            <form action="/logout" method="post" class="inline">
                @csrf
                <button type="submit" class="hover:text-error hidden cursor-pointer md:inline-block">Logout</button>
            </form>
        @else
            <a href="/login" class="hover:text-primary mr-2">Login</a>
            <a href="/register" class="hover:text-primary hidden md:inline-block">Register</a>
        @endif

        <button type="button" class="btn btn-circle btn-active btn-sm" data-theme-toggle
                aria-label="Toggle theme">
            <svg data-theme-icon-light xmlns="http://www.w3.org/2000/svg" class="size-5 hidden" fill="none"
                 viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                      d="M12 3v1.5m0 15V21m6.364-15.364-1.06 1.06M6.696 17.304l-1.06 1.06M21 12h-1.5m-15 0H3m15.364 6.364-1.06-1.06M6.696 6.696l-1.06-1.06M15.75 12a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0Z" />
            </svg>
            <svg data-theme-icon-dark xmlns="http://www.w3.org/2000/svg" class="size-5 hidden" fill="none"
                 viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                      d="M21.752 15.002A9.718 9.718 0 0 1 18 15.75c-5.385 0-9.75-4.365-9.75-9.75 0-1.33.267-2.598.752-3.752A9.75 9.75 0 1 0 21.752 15.002Z" />
            </svg>
        </button>
    </div>
</div>
