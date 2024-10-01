<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <link rel="icon" type="image/png" sizes="32x32" href="https://portalcolombia.terpel.com/static/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16"
        href="https://portalcolombia.terpel.com/static/favicon-16x16.png">
    <link rel="icon" href="https://portalcolombia.terpel.com/static/favicon.svg" type="image/svg+xml">
    <link rel="icon" href="https://portalcolombia.terpel.com/static/favicon.ico" type="image/x-icon">

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link rel="stylesheet" href="css/styles.css">
    <link rel="stylesheet" href="css/login.css">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    {{-- @vite(['resources/css/app.css', 'resources/js/app.js']) --}}
</head>

<body>
    <div class="main-guest-container">
        {{ $slot }}
    </div>
</body>

</html>
