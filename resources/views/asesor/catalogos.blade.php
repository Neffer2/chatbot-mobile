@extends('layouts.layout')

@section('content')
    <div class="main-catalogos-container">
        <div class="catalogos-title-bar">
            <h1>Catálogos</h1>
        </div>
        <div class="catalogos-container">
            <div class="catalogo-item">
                <h2>Cátalogo plan PDV</h2>
                {{-- Plan PDV PDF --}}
                <div class="catalogo-image-container">
                    <img src="{{ asset('assets/catalogo_plan_pdv.png') }}" alt="Cátalogo plan PDV" class="catalogo-image">
                </div>
                <a href="{{ asset('assets/cat_plan_pdv.pdf') }}" class="catalogo-button" download>Descargar</a>
            </div>
            <div class="catalogo-item">
                <h2>Cátalogo Ultrek</h2>
                <div class="catalogo-image-container">
                    <img src="{{ asset('assets/catalogo_ultrek.png') }}" alt="Cátalogo Ultrek" class="catalogo-image">
                </div>
                <a href="{{ asset('assets/cat_ultrek.pdf') }}" class="catalogo-button" download>Descargar</a>
            </div>
            <div class="catalogo-item">
                <h2>Cátalogo Oiltec</h2>
                <div class="catalogo-image-container">
                    <img src="{{ asset('assets/catalogo_oiltec.png') }}" alt="Cátalogo Oiltec" class="catalogo-image">
                </div>
                <a href="{{ asset('assets/cat_oiltec.pdf') }}" class="catalogo-button" download>Descargar</a>
            </div>
            <div class="catalogo-item">
                <h2>Cátalogo Celerity</h2>
                <div class="catalogo-image-container">
                    <img src="{{ asset('assets/catalogo_celerity.png') }}" alt="Cátalogo Celerity" class="catalogo-image">
                </div>
                <a href="{{ asset('assets/cat_celerity.pdf') }}" class="catalogo-button" download>Descargar</a>
            </div>
            <div class="catalogo-item">
                <h2>Cátalogo Refrigerantes</h2>
                <div class="catalogo-image-container">
                    <img src="{{ asset('assets/catalogo_refrigerantes.png') }}" alt="Cátalogo Refrigerantes" class="catalogo-image">
                </div>
                <a href="{{ asset('assets/cat_refrigerantes.pdf') }}" class="catalogo-button" download>Descargar</a>
            </div>
            <div class="ia-button-container">
                <button class="ia-button">Interactúa con la inteligencia artificial</button>
            </div>
        </div>

        
    </div>
@endsection