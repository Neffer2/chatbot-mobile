<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="css/agente.css">
    <link rel="stylesheet" href="css/asesor.css">
    <link rel="stylesheet" href="css/catalogos.css">
    <link rel="stylesheet" href="css/data-asesor.css">
    <link rel="stylesheet" href="css/header.css">
    <link rel="stylesheet" href="css/login.css">
    <link rel="stylesheet" href="css/navbar.css">
    <link rel="stylesheet" href="css/premios.css">
    <link rel="stylesheet" href="css/ranking.css">
    <link rel="stylesheet" href="css/styles.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <title>Landing</title>
</head>

<body>
    <header class="header">
        <div class="header-content">
            <div class="user-info">
                {{ Auth::user()->name }} {{ Auth::user()->apellido }}
                <i class="fas fa-circle-user user-icon"></i>
            </div>
        </div>
    </header>
    @if (Auth::user()->rol_id == 3)
        
    @endif
    <div class="">
        <div class="data-asesor">
            <div class="data-item-asesor">Cobertura: 60</div>
            <div class="data-item-asesor">Volumen: 50</div>
            <div class="data-item-asesor">Visibilidad: 20</div>
            <div class="data-item-asesor">Frecuencia: 10</div>
            <div class="data-item-asesor">Precio: 10</div>
            <div class="data-item-asesor">Puntos Acumulados: 150</div>
        </div>
    </div>
    <button class="menu-button" id="menu-button" aria-label="Menu">
        <i class="fas fa-bars"></i>
        <i class="fas fa-times"></i>
    </button>
    <nav class="navbar" id="navbar">
        <div class="logo-container">
            <a href="/"><img src="{{ asset('assets/mobil-terpel.png') }}" alt="Logo"></a>
        </div>
        <ul class="nav-list">
            @if (Auth::user()->rol_id == 2)
                <!-- Rol Agente -->
                <li class="{{ request()->is('/') ? 'active' : '' }}"><a href="/">Home</a></li>
            @elseif(Auth::user()->rol_id == 3)
                <!-- Rol Asesor -->
                <li class="{{ request()->is('/') ? 'active' : '' }}"><a href="/">Mis Metas</a></li>
                <li class="{{ request()->is('ranking') ? 'active' : '' }}"><a href="/ranking">Ranking</a></li>
                <li class="{{ request()->is('premios') ? 'active' : '' }}"><a href="/premios">Premios</a></li>
                <li class="{{ request()->is('catalogos') ? 'active' : '' }}"><a href="/catalogos">Catálogos</a></li>
            @endif
            <li class="tyc-link {{ request()->is('assets/legal/tyc-plan-incentivos-terpel.pdf') ? 'active' : '' }}">
                <a href="{{ asset('assets/legal/tyc-plan-incentivos-terpel.pdf') }}" target="_blank">Términos y
                    condiciones</a>
            </li>
        </ul>
    </nav>

    @yield('content')

    <a href="https://wa.me/1234567890" class="whatsapp-float" target="_blank">
        <i class="fab fa-whatsapp whatsapp-icon"></i>
    </a>

    <script>
        document.getElementById('menu-button').addEventListener('click', function() {
            this.classList.toggle('active');
            document.getElementById('navbar').classList.toggle('active');
        });
    </script>
</body>

</html>
