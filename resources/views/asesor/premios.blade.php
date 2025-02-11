@extends('layouts.layout')

@section('content')
    <div class="main-premios-container">
        <div class="premios-title-bar">
            <h1>Premios</h1>
        </div>
        <div class="premios-container">
            <div class="premios-left">
                @foreach ($premios as $key => $premio)
                    @php
                        $foto_premio = "";
                        if ($key == 0) {
                            $foto_premio = 'assets/premios/premio_cartagena.png';
                        }elseif ($key == 1) {
                            $foto_premio = 'assets/premios/premio_scooter.png';
                        }elseif ($key == 2) {
                            $foto_premio = 'assets/premios/premio_smarttv.png';
                        }elseif ($key == 3) {
                            $foto_premio = 'assets/premios/premio_morral.png';
                        }
                    @endphp
                    <div class="premio-item">
                        <h2>{{ $premio->nombre }}</h2>
                        <div class="premio-image-container">
                            <img src="{{ asset($foto_premio) }}"
                                alt="Viaje para 2 todo incluído a Cartagena" class="premio-image">
                        </div>
                    </div>
                    @if ($key == 3) @break @endif
                @endforeach
            </div>
            <div class="premios-right">
                @foreach ($premios as $key => $premio)
                    @if ($key > 3)
                        @php
                            if ($key == 3) {
                                $foto_premio = 'assets/premios/premio_morral.png';
                            }elseif ($key == 4) {
                                $foto_premio = 'assets/premios/premio_parlante.png';
                            }elseif ($key == 5) {
                                $foto_premio = 'assets/premios/premio_bonos_ns.png';
                            }
                        @endphp
                        <div class="premio-item">
                            <h2>{{ $premio->nombre }}</h2>
                            <div class="premio-image-container">
                                <img src="{{ asset($foto_premio) }}"
                                    alt="Viaje para 2 todo incluído a Cartagena" class="premio-image">
                            </div>
                            {{-- <p>{{ number_format(floor($premio->puntos), 0) }} Puntos</p> --}}
                        </div>
                    @endif
                @endforeach
            </div>
        </div>
        <div class="instrucciones-container">
            <h2>Cómo canjear tus puntos:</h2>
            <p>Si quieres reclamar uno de los premios de nuestro catálogo, debes seguir estos pasos:</p>
            <ol>
                <li>Ingresa al chatbot de whatsapp del Plan Choque Visionarios e interactua con GuIA.</li>
                <li>En el menú principal, selecciona la opción "Consultar Incentivos".</li>
                <li>Después selecciona la opción "Canjea tus puntos".</li>
                <li>Elige el premio que deseas obtener. Ten muy presente los puntos que has acumulado y si son suficientes
                    para reclamar tu premio.</li>
                <li>Luego, agenda la entrega de tu premio. Digita tu dirección y fecha estimada para gestionar el envío.
                    Nota: Cuando confirmes el envío de tu premio, se descontarán los puntos equivalentes de tu puntaje
                    acumulado.</li>
                <li>¡Y eso es todo! Disfruta de tu premio una vez llegue a tus manos.</li>
            </ol>
        </div>
    </div>
@endsection
