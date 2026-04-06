<div class="navbar bg-base-100 shadow-sm px-3 md:px-5 lg:px-10">
    <div class="flex-1">
        <a class="font-bold text-2xl" href="/">Vixlo</a>
    </div>
    <div class="flex-none">
        @if(auth()->check())
            <img src="{{ auth()->user()->photo }}" alt="Profile Picture" class="w-10 rounded-full inline mr-2" />
            <a href="/dashboard" class="hover:text-primary font-bold mr-2">Dashboard</a>
            <form action="/logout" method="post" class="inline">
                @csrf
                <button type="submit" class="hover:text-error font-bold hidden md:inline-block">Logout</button>
            </form>
        @else
            <a href="/login" class="hover:text-primary font-bold mr-2">Login</a>
            <a href="/register" class="hover:text-primary font-bold hidden md:inline-block">Register</a>
        @endif
    </div>
</div>
