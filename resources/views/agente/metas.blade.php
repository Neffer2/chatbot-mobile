@extends('layouts.layout')
@section('content')
    <div>
        <div class="main-asesor-container">
            <div class="table-container">
                <div class="table-header">Metas generales</div>
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
                        @php
                            $porcentaje_cobertura = $meta_cobertura > 0 ? ($cobertura / $meta_cobertura) * 100 : 0;
                        @endphp
                        <div class="progress-bar">
                            <div class="progress" style="width: {{ $porcentaje_cobertura }}%;"></div>
                        </div>
                    </div>
                    <div class="table-cell">
                        @php
                            $porcentaje_volumen = $meta_volumen > 0 ? ($volumen / $meta_volumen) * 100 : 0;
                        @endphp
                        <div class="progress-bar">
                            <div class="progress" style="width: {{ $porcentaje_volumen }}%;"></div>
                        </div>
                    </div>
                    <div class="table-cell">
                        @php
                            $porcentaje_visibilidad = $meta_visibilidad > 0 ? ($visibilidad / $meta_visibilidad) * 100 : 0;
                        @endphp
                        <div class="progress-bar">
                            <div class="progress" style="width: {{ $porcentaje_visibilidad }}%;"></div>
                        </div>
                    </div>
                    <div class="table-cell">
                        @php
                            $porcentaje_frecuencia = $meta_frecuencia > 0 ? ($frecuencia / $meta_frecuencia) * 100 : 0;
                        @endphp
                        <div class="progress-bar">
                            <div class="progress" style="width: {{ $porcentaje_frecuencia }}%;"></div>
                        </div>
                    </div>
                    <div class="table-cell">
                        @php
                            $porcentaje_precio = $meta_precio > 0 ? ($precio / $meta_precio) * 100 : 0;
                        @endphp
                        <div class="progress-bar">
                            <div class="progress" style="width: {{ $porcentaje_precio }}%;"></div>
                        </div>
                    </div>
    
                    <div class="table-cell row-header"></div>
                    <div class="table-cell">{{ round($porcentaje_cobertura, 2) }}%</div>
                    <div class="table-cell">{{ round($porcentaje_volumen, 2) }}%</div>
                    <div class="table-cell">{{ round($porcentaje_visibilidad, 2) }}%</div>
                    <div class="table-cell">{{ round($porcentaje_frecuencia, 2) }}%</div>
                    <div class="table-cell">{{ round($porcentaje_precio, 2) }}%</div>
                </div>
            </div>
        </div>
    </div>
@endsection