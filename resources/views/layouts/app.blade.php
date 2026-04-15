<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script>
        (() => {
            const storedTheme = localStorage.getItem('theme');
            const prefersDark = window.matchMedia('(prefers-color-scheme: dark)').matches;
            const theme = storedTheme === 'light' || storedTheme === 'dark'
                ? storedTheme
                : (prefersDark ? 'dark' : 'light');

            document.documentElement.setAttribute('data-theme', theme);
        })();
    </script>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <title>@yield('title') - VX Auth</title>
</head>
<body class="min-h-screen flex flex-col">
@php
    $isDashboardArea = auth()->check() && (request()->routeIs('home') || request()->routeIs('dashboard*'));
@endphp

@if($isDashboardArea)
    <div class="drawer lg:drawer-open min-h-screen">
    <input id="dashboard-drawer" type="checkbox" class="drawer-toggle" />
    <div class="drawer-content flex flex-col min-h-screen">
            @include('components.header')
            <main class="grow container mx-auto w-full">
                @yield('content')
            </main>
            @include('components.footer')
        </div>
    <div class="drawer-side">
        <label for="dashboard-drawer" class="drawer-overlay"></label>
        <x-dashboard-sidebar />
    </div>
</div>
@else
    @include('components.header')
    <main class="grow container mx-auto w-full">
        @yield('content')
    </main>
    @include('components.footer')
@endif
</body>
</html>
