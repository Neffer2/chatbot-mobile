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
                @foreach ($visitas as $visita)
                    <tr>
                        <td>{{ $visita->id }}</td>
                        <td>{{ $visita->puntoVenta->descripcion }}</td>
                        <<td>
                            @if ($visita->foto_factura)
                                <a href="{{ asset($visita->foto_factura) }}" target="_blank" class="truncate-link">
                                    {{ asset($visita->foto_factura) }}
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
@endsection