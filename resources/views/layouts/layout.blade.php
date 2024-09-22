<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="css/asesor.css">
    <link rel="stylesheet" href="css/header.css">
    <link rel="stylesheet" href="css/login.css">
    <link rel="stylesheet" href="css/navbar.css">
    <link rel="stylesheet" href="css/styles.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <title>Landing</title>
</head>

<body>
    <header class="header">
        <div class="header-content">
            <div class="user-info">
                {{ Auth::user()->name }} {{ Auth::user()->apellido }}
            </div>
        </div>
    </header>
    <button class="menu-button" id="menu-button" aria-label="Menu">
        <i class="fas fa-bars"></i>
        <i class="fas fa-times"></i>
    </button>
    <nav class="navbar" id="navbar">
        <div class="logo-container">
            <img src="{{ asset('assets/mobil-terpel.png') }}" alt="Logo">
        </div>
        <ul class="nav-list">
            @if (Auth::user()->rol_id == 2)
                <!-- Rol Agente -->
                <li><a href="/">Home</a></li>
                <li><a href="#">Vistas por aprobar</a></li>
                <li><a href="#">Meta global</a></li>
                <li><a href="#">Reporte zona</a></li>
                <li><a href="#">Reporte por asesor</a></li>
            @elseif(Auth::user()->rol_id == 3)
                <!-- Rol Asesor -->
                <li><a href="/">Mis Metas</a></li>
                <li><a href="#">Ranking</a></li>
                <li><a href="#">Premios</a></li>
                <li><a href="#">Catálogos</a></li>
            @endif
            <li><a href="{{ asset('assets/legal/tyc-plan-incentivos-terpel.pdf') }}" target="_blank">Términos y
                    condiciones</a></li>
        </ul>
    </nav>

    @yield('content')

    <script>
        document.getElementById('menu-button').addEventListener('click', function() {
            this.classList.toggle('active');
            document.getElementById('navbar').classList.toggle('active');
        });
    </script>
</body>

</html>
