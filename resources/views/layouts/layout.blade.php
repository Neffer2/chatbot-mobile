<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="css/styles.css">
    <link rel="stylesheet" href="css/login.css">
    <link rel="stylesheet" href="css/navbar.css">
    <link rel="stylesheet" href="css/header.css">
    <link rel="stylesheet" href="css/asesor.css">
    <title>Landing</title>
</head>

<body>
    <header class="header">
        <div class="header-content">
            <div class="user-info">
                <span>{{ Auth::user()->name }} {{ Auth::user()->apellido }}</span>
            </div>
        </div>
    </header>
    <nav class="navbar">
        <div class="logo-container">
            <img src="{{ asset('assets/mobil-terpel.png') }}" alt="Logo">
        </div>
        <ul class="nav-list">
            {{-- <li><a href="#">Home</a></li> --}}
            <li><a href="#">Mis Metas</a></li>
            <li><a href="#">Ranking</a></li>
            <li><a href="#">Plan Choque</a></li>
            <li><a href="#">Mecánica</a></li>
            <li><a href="#">Premios</a></li>
            <li><a href="#">Productos</a></li>
        </ul>
    </nav>

    @yield('content')
</body>

</html>
