@extends('layouts.layout')
@section('content')
    <div class="main-ranking-container">
        <div class="ranking-title-bar">
            <h1>Ranking</h1>
        </div>
        <div class="ranking-container">
            <div class="ranking-podium-container">
                <div class="ranking-podium">
                    <div class="copa" id="copa-2">
                        <img src="{{ asset('assets/asesor2copa.png') }}" alt="Asesor 2">
                        <span>Asesor 2</span>
                    </div>
                    <div class="copa" id="copa-1">
                        <img src="{{ asset('assets/asesor1copa.png') }}" alt="Asesor 1">
                        <span>Asesor 1</span>
                    </div>
                    <div class="copa" id="copa-3">
                        <img src="{{ asset('assets/asesor3copa.png') }}" alt="Asesor 3">
                        <span>Asesor 3</span>
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
    </div>
@endsection
