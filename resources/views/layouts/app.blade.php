<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @vite('resources/css/app.css')
    <title>@yield('title') - VX Auth</title>
</head>
<body class="flex flex-col min-h-screen">
@include('components.header')
<main class="grow container mx-auto">
    @yield('content')
</main>
@include('components.footer')
</body>
</html>
