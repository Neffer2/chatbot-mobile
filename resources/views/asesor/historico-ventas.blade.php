@extends('layouts.layout')

@section('content')
    <div class="main-historico-ventas-container">
        <h2>Histórico de Ventas</h2>
        <table class="styled-table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Descripción del Punto de Venta</th>
                    <th>Foto Factura</th>
                    <th>Fecha</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($visitas as $index => $visita)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $visita->puntoVenta->descripcion }}</td>
                        <td>
                            @if ($visita->foto_factura)
                                @php
                                    $foto_factura_path = str_replace('public/', 'storage/', $visita->foto_factura);
                                @endphp
                                <a href="{{ asset($foto_factura_path) }}" target="_blank" class="truncate-link">
                                    {{ asset($foto_factura_path) }}
                                </a>
                            @else
                                N/A
                            @endif
                        </td>
                        <td>{{ $visita->created_at }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <div class="main-historico-ventas-container">
        <h2>Histórico de Galonaje</h2>
        <table class="styled-table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Descripción del Punto de Venta</th>
                    <th>N&uacute;mero de ventas</th>
                    <th>Galonaje acumulado</th>
                    <th>Puntos sumados</th>
                </tr>
            </thead>
            <tbody>
                @php
                    $acumVentas = 0;
                    $acumGal = 0;
                    $acumPuntos = 0;
                @endphp
                @foreach ($puntos as $index => $punto)
                    @php
                        $tempVentas = $punto->visitas->where('estado_id_agente', 1)->whereNotNull('foto_factura')->count();
                        $tempGal = $punto->visitas->where('estado_id_agente', 1)->sum('valor_factura');
                        $tempPuntos = $punto->visitas->map(function($visita) {return $visita->registroVisitas->sum('puntos');})->sum();
                    @endphp
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $punto->descripcion }}</td>
                        <td>{{ $tempVentas }}</td>
                        <td>{{ $tempGal }}</td>
                        <td>{{ $tempPuntos }}</td>

                        @php
                            $acumVentas += $tempVentas;
                            $acumGal += $tempGal;
                            $acumPuntos += $tempPuntos;
                        @endphp
                    </tr>
                @endforeach
                <tr style="font-weight: bold;">
                    <td colspan="2">TOTAL</td>
                    <td>{{ $acumVentas }}</td>
                    <td>{{ $acumGal }}</td>
                    <td>{{ $acumPuntos }}</td>
                </tr>
            </tbody>
        </table>
    </div>
@endsection
