@extends('layouts.layout')

@section('content')
    <div class="main-premios-container">
        <div class="premios-title-bar">
            <h1>Premios</h1>
        </div>
        <div class="premios-container">
            <div class="premios-left">
                <div class="premio-item">
                    <h2>Viaje para 2 todo incluído a Cartagena</h2>
                    <div class="premio-image-container">
                        <img src="{{ asset('assets/premios/premio_cartagena.png') }}"
                            alt="Viaje para 2 todo incluído a Cartagena" class="premio-image">
                    </div>
                    <p>XXX Puntos</p>
                </div>
                <div class="premio-item">
                    <h2>Smart TV 55''</h2>
                    <div class="premio-image-container">
                        <img src="{{ asset('assets/premios/premio_smarttv.png') }}" alt="Smart TV 55''"
                            class="premio-image">
                    </div>
                    <p>XXX Puntos</p>
                </div>
                <div class="premio-item">
                    <h2>Scooter</h2>
                    <div class="premio-image-container">
                        <img src="{{ asset('assets/premios/premio_scooter.png') }}" alt="Scooter" class="premio-image">
                    </div>
                    <p>XXX Puntos</p>
                </div>
            </div>
            <div class="premios-right">
                <div class="premio-item">
                    <h2>Morral</h2>
                    <div class="premio-image-container">
                        <img src="{{ asset('assets/premios/premio_morral.png') }}" alt="Morral" class="premio-image">
                    </div>
                    <p>XXX Puntos</p>
                </div>
                <div class="premio-item">
                    <h2>Parlante bluetooth</h2>
                    <div class="premio-image-container">
                        <img src="{{ asset('assets/premios/premio_parlante.png') }}" alt="Parlante bluetooth"
                            class="premio-image">
                    </div>
                    <p>XXX Puntos</p>
                </div>
                <div class="premio-item">
                    <h2>Tarjetas de regalo</h2>
                    <div class="premio-image-container">
                        <img src="{{ asset('assets/premios/premio_bonos_spotify_netflix.png') }}" alt="Tarjetas de regalo"
                            class="premio-image">
                    </div>
                    <p>XXX Puntos</p>
                </div>
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
