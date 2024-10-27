<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="shortcut icon" href="{{ asset('images/icons/favicon.svg') }}">

    <title>@yield('title', 'User Management System')</title>

    @stack('vite')
    <link rel="stylesheet" href="{{ asset('css/base/index.css') }}">
    <link rel="stylesheet" href="{{ asset('css/base/messages.css') }}">
    @stack('styles')
</head>

<body class="body__container">
    <main class="main__container">
        @yield('content')
    </main>
</body>
</html>