@extends('layouts.layout')
@section('content')
    <div class="main-asesor-container">
        <div class="table-container">
            <div class="table-header">Mis Metas</div>
            <div class="table-grid">
                <!-- Column Headers -->
                <div class="table-cell header"></div>
                <div class="table-cell header">COBERTURA</div>
                <div class="table-cell header">VOLUMEN</div>
                <div class="table-cell header">VISIBILIDAD</div>
                <div class="table-cell header">FRECUENCIA</div>
                <div class="table-cell header">PRECIO</div>

                <!-- Row: Meta -->
                <div class="table-cell row-header">Meta</div>
                <div class="table-cell">{{ $meta_cobertura }}</div>
                <div class="table-cell">{{ $meta_volumen }}</div>
                <div class="table-cell">{{ $meta_visibilidad }}</div>
                <div class="table-cell">{{ $meta_frecuencia }}</div>
                <div class="table-cell">{{ $meta_precio }}</div>

                <!-- Row: Ejecución -->
                <div class="table-cell row-header">Ejecución</div>
                <div class="table-cell">{{ $cobertura }}</div>
                <div class="table-cell">{{ $volumen }}</div>
                <div class="table-cell">{{ $visibilidad }}</div>
                <div class="table-cell">{{ $frecuencia }}</div>
                <div class="table-cell">{{ $precio }}</div>

                <!-- Row: Porcentaje Ejecución -->
                <div class="table-cell row-header">Porcentaje Ejecución</div>
                <div class="table-cell">
                    <div class="progress-bar">
                        <div class="progress"
                            style="width: {{ $meta_cobertura > 0 ? ($cobertura / $meta_cobertura) * 100 : 0 }}%;"></div>
                    </div>
                </div>
                <div class="table-cell">
                    <div class="progress-bar">
                        <div class="progress"
                            style="width: {{ $meta_volumen > 0 ? ($volumen / $meta_volumen) * 100 : 0 }}%;"></div>
                    </div>
                </div>
                <div class="table-cell">
                    <div class="progress-bar">
                        <div class="progress"
                            style="width: {{ $meta_visibilidad > 0 ? ($visibilidad / $meta_visibilidad) * 100 : 0 }}%;">
                        </div>
                    </div>
                </div>
                <div class="table-cell">
                    <div class="progress-bar">
                        <div class="progress"
                            style="width: {{ $meta_frecuencia > 0 ? ($frecuencia / $meta_frecuencia) * 100 : 0 }}%;">
                        </div>
                    </div>
                </div>
                <div class="table-cell">
                    <div class="progress-bar">
                        <div class="progress"
                            style="width: {{ $meta_precio > 0 ? ($precio / $meta_precio) * 100 : 0 }}%;"></div>
                    </div>
                </div>

                <div class="table-cell row-header"></div>
                <div class="table-cell">%</div>
                <div class="table-cell">%</div>
                <div class="table-cell">%</div>
                <div class="table-cell">%</div>
                <div class="table-cell">%</div>
            </div>
        </div>
        <div class="ranking-link-container">
            <a href="{{ url('/ranking') }}">
                <img src="{{ asset('assets/ranking-asesores.png') }}" alt="Ranking Asesores" class="ranking-link-image">
            </a>
            <a href="{{ url('/ranking') }}">
                <img src="{{ asset('assets/ranking-pdv.png') }}" alt="Ranking PDV" class="ranking-link-image">
            </a>
        </div>

    </div>
@endsection
