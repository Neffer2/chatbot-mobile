@extends('layouts.layout')
@section('content')
    <div class="main-ranking-container">
        <div class="ranking-title-bar">
            <h1>Ranking de Asesores</h1>
        </div>
        <div class="ranking-container">
            <div class="ranking-podium-container">
                <div class="ranking-podium">
                    <div class="copa" id="copa-2">
                        <img src="{{ asset('assets/Asesor2Copa.png') }}" alt="{{ $topUsers[1]->name }}">
                        <span>{{ $topUsers[1]->name }} {{ $topUsers[1]->apellido }}</span>
                        <span class="span-puntos-ranking">{{ $topUsers[1]->puntos }}</span>
                    </div>
                    <div class="copa" id="copa-1">
                        <img src="{{ asset('assets/Asesor1Copa.png') }}" alt="{{ $topUsers[0]->name }}">
                        <span>{{ $topUsers[0]->name }} {{ $topUsers[0]->apellido }}</span>
                        <span class="span-puntos-ranking">{{ $topUsers[0]->puntos }}</span>
                    </div>
                    <div class="copa" id="copa-3">
                        <img src="{{ asset('assets/Asesor3Copa.png') }}" alt="{{ $topUsers[2]->name }}">
                        <span>{{ $topUsers[2]->name }} {{ $topUsers[2]->apellido }}</span>
                        <span class="span-puntos-ranking">{{ $topUsers[2]->puntos }}</span>
                    </div>
                    <img src="{{ asset('assets/ranking-podium.png') }}" alt="Podio" class="podium">
                </div>
            </div>
            <div class="ranking-list">
                @foreach ($topUsers as $index => $user)
                    <div class="ranking-item {{ $index < 3 ? 'top-three' : 'top-ten' }}">
                        <span class="ranking-position">{{ $index + 1 }}</span>
                        <span class="ranking-name">{{ $user->name }} {{ $user->apellido }}</span>
                        <span class="ranking-points">{{ $user->puntos }}</span>
                    </div>
                @endforeach
            </div>
        </div>

        <div class="ranking-title-bar">
            <h1>Ranking PDV</h1>
        </div>
        <div class="ranking-container">
            <div class="ranking-podium-container">
                <div class="ranking-podium">
                    <div class="copa" id="copa-2">
                        <img src="{{ asset('assets/Asesor2Copa.png') }}" alt="Asesor 2">
                        <span>PDV 2</span>
                    </div>
                    <div class="copa" id="copa-1">
                        <img src="{{ asset('assets/Asesor1Copa.png') }}" alt="Asesor 1">
                        <span>PDV 1</span>
                    </div>
                    <div class="copa" id="copa-3">
                        <img src="{{ asset('assets/Asesor3Copa.png') }}" alt="Asesor 3">
                        <span>PDV 3</span>
                    </div>
                    <img src="{{ asset('assets/ranking-podium.png') }}" alt="Podio" class="podium">
                </div>
            </div>
            <div class="ranking-list">
                {{-- Ranking PDV --}}
                @foreach ($topPuntosVenta as $index => $topPuntosVenta)
                    <div class="ranking-item {{ $index < 3 ? 'top-three' : 'top-ten' }}">
                        <span class="ranking-position">{{ $index + 1 }}</span>
                        <span class="ranking-name">{{ $topPuntosVenta->descripcion }}</span>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endsection
