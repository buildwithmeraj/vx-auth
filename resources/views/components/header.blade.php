@php
    $isDashboardArea = auth()->check() && (request()->routeIs('home') || request()->routeIs('dashboard*'));
@endphp

<div class="navbar bg-base-100 shadow-sm px-3 md:px-5 lg:px-10">
    <div class="flex-1 flex items-center gap-2">
        @if($isDashboardArea)
            <label for="dashboard-drawer" class="cursor-pointer drawer-trigger lg:hidden">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                </svg>
            </label>
        @endif

        <a class="font-bold text-2xl" href="/">Vixlo</a>
    </div>
    <div class="flex-none">
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
    </div>
</div>
