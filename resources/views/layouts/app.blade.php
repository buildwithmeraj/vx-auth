<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @vite('resources/css/app.css')
    <title>@yield('title') - VX Auth</title>
</head>
<body class="min-h-screen">
@php
    $isDashboardArea = auth()->check() && (request()->routeIs('home') || request()->routeIs('dashboard*'));
@endphp

@if($isDashboardArea)
    <div class="drawer lg:drawer-open">
        <input id="dashboard-drawer" type="checkbox" class="drawer-toggle hidden" />
        <div class="drawer-content flex flex-col min-h-screen">
            @include('components.header')
            <main class="grow container mx-auto w-full">
                @yield('content')
            </main>
            @include('components.footer')
        </div>

        <div class="drawer-side z-40">
            <label for="dashboard-drawer" aria-label="close sidebar" class="drawer-overlay"></label>
            <x-dashboard-sidebar />
        </div>
    </div>
@else
    @include('components.header')
    <main class="grow container mx-auto">
        @yield('content')
    </main>
    @include('components.footer')
@endif
</body>
</html>
