<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="css/agente.css?v={{ time() }}">
    <link rel="stylesheet" href="css/asesor.css?v={{ time() }}">
    <link rel="stylesheet" href="css/catalogos.css?v={{ time() }}">
    <link rel="stylesheet" href="css/data-asesor.css?v={{ time() }}">
    <link rel="stylesheet" href="css/header.css?v={{ time() }}">
    <link rel="stylesheet" href="css/historico-registros.css?v={{ time() }}">
    <link rel="stylesheet" href="css/historico-ventas.css?v={{ time() }}">
    <link rel="stylesheet" href="css/login.css?v={{ time() }}">
    <link rel="stylesheet" href="css/navbar.css?v={{ time() }}">
    <link rel="stylesheet" href="css/premios.css?v={{ time() }}">
    <link rel="stylesheet" href="css/puntos-venta.css?v={{ time() }}">
    <link rel="stylesheet" href="css/ranking.css?v={{ time() }}">
    <link rel="stylesheet" href="css/styles.css?v={{ time() }}">
    <link rel="stylesheet" href="css/visitas.css?v={{ time() }}">
    <link rel="icon" type="image/png" sizes="32x32"
        href="https://portalcolombia.terpel.com/static/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16"
        href="https://portalcolombia.terpel.com/static/favicon-16x16.png">
    <link rel="icon" href="https://portalcolombia.terpel.com/static/favicon.svg" type="image/svg+xml">
    <link rel="icon" href="https://portalcolombia.terpel.com/static/favicon.ico" type="image/x-icon">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <title>Plan Choque Visionarios</title>
</head>

<body>
    <header class="header">
        <div class="header-content">
            <div class="user-info">
                {{ Auth::user()->name }} {{ Auth::user()->apellido }}
                @if (Auth::user()->rol_id == 2 || Auth::user()->rol_id == 1)
                    @if (Auth::user()->rol_id == 1)
                        (Organización Terpel)
                    @else
                        ({{ Auth::user()->empresa_id == 1 ? 'RYR' : (Auth::user()->empresa_id == 2 ? 'Cia Lubricantes' : 'Ludelpa') }})
                    @endif

                @endif
                <i class="fas fa-circle-user user-icon"></i>
                <a href="/logout"><i class="fa-solid fa-arrow-right-from-bracket"></i></a>
            </div>
        </div>
    </header>
    @if (Auth::user()->rol_id == 3)
        <div class="">
            <div class="data-asesor">
                <div class="data-item-asesor">Cobertura: {{ Auth::user()->getCobertura() }}</div>
                <div class="data-item-asesor">Volumen: {{ Auth::user()->getVolumen() }}</div>
                <div class="data-item-asesor">Visibilidad: {{ Auth::user()->getVisibilidad() }}</div>
                <div class="data-item-asesor">Frecuencia: {{ Auth::user()->getFrecuencia() }}</div>
                <div class="data-item-asesor">Precio: {{ Auth::user()->getPrecio() }}</div>
                <div class="data-item-asesor puntos-acumulados">Puntos Acumulados: {{ Auth::user()->puntaje() }}</div>
            </div>
        </div>
    @endif

    <button class="menu-button" id="menu-button" aria-label="Menu">
        <i class="fas fa-bars"></i>
        <i class="fas fa-times"></i>
    </button>
    <nav class="navbar" id="navbar">
        <div class="logo-container">
            <a href="/"><img src="{{ asset('assets/mobil-terpel.png') }}" alt="Logo"></a>
        </div>
        <ul class="nav-list">
            @if (Auth::user()->rol_id == 2 || Auth::user()->rol_id == 1)
                <!-- Rol Agente -->
                <li class="{{ request()->is('/') ? 'active' : '' }}"><a href="/">Home</a></li>
                @if (Auth::user()->rol_id == 1)
                    <li class="{{ request()->is('metas') ? 'active' : '' }}"><a href="/metas">Metas</a></li>
                @endif
                @if (Auth::user()->rol_id == 2)
                    <li class="{{ request()->is('visitas') ? 'active' : '' }}"><a href="/ventas-aprobar">Ventas por
                            aprobar</a></li>
                @endif
            @elseif(Auth::user()->rol_id == 3)
                <!-- Rol Asesor -->
                <li class="{{ request()->is('/') ? 'active' : '' }}"><a href="/">Mis Metas</a></li>
                <li class="{{ request()->is('ranking') ? 'active' : '' }}"><a href="/ranking">Rankings</a></li>
                <li class="{{ request()->is('premios') ? 'active' : '' }}"><a href="/premios">Premios</a></li>
                <li class="{{ request()->is('catalogos') ? 'active' : '' }}"><a href="/catalogos">Catálogos</a></li>
                <li class="{{ request()->is('historico-registros') ? 'active' : '' }}"><a
                        href="/historico-registros">Historico de Registros</a></li>
                <li class="{{ request()->is('historico-ventas') ? 'active' : '' }}"><a
                        href="/historico-ventas">Historico de Ventas</a></li>
            @endif
            {{-- Terminos y Condiciones --}}
            <li class="tyc-link {{ request()->is('assets/legal/tyc-plan-incentivos-terpel.pdf') ? 'active' : '' }}">
                <a class="terminos-nav" href="{{ asset('') }}" target="_blank">Términos y
                    condiciones</a>
            </li>
        </ul>
    </nav>

    @yield('content')
    @if (Auth::user()->rol_id == 3)
        <a href="https://wa.me/573212282774?text=Hola%2C+quiero+hacer+mi+prueba+en+el+Chatbot+Plan+Choque+Visionarios."
            class="whatsapp-float" target="_blank">
            <i class="fab fa-whatsapp whatsapp-icon"></i>
        </a>
    @endif

    <script>
        document.getElementById('menu-button').addEventListener('click', function() {
            this.classList.toggle('active');
            document.getElementById('navbar').classList.toggle('active');
        });
    </script>
</body>


</html>
