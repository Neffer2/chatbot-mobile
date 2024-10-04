@extends('layouts.layout')

@section('content')
    <div class="main-historico-registros-container">

        <h2>Histórico de Registros</h2>
        <table class="styled-table">
            <thead>
                <tr>
                    <th>#</th>
                    <th>PDV Inscrito</th>
                    <th>Punto</th>
                    <th>Referencias</th>
                    <th>Presentaciones</th>
                    <th>Num cajas</th>
                    <th>Foto Punto</th>
                    <th>Foto Factura</th>
                    <th>Foto Precios</th>
                    <th>Valor Factura</th>
                    <th>Estados</th>
                    <th>Observaciones</th>
                    <th>Fecha</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($registros as $visita)
                    <tr>
                        <td>{{ $visita->id }}</td>
                        <td class="truncate-link">
                            {{ $visita->pdv_inscrito ?? 'N/A' }}
                        </td>
                        <td>{{ $visita->puntoVenta->descripcion }}</td>
                        <td>{{ $visita->referencias }}</td>
                        <td>{{ $visita->presentaciones }}</td>
                        <td>{{ $visita->num_cajas }}</td>
                        <td>
                            @if ($visita->foto_pop)
                                @php
                                    $foto_pop_path = str_replace('public/', 'storage/', $visita->foto_pop);
                                @endphp
                                <a href="{{ asset($foto_pop_path) }}" target="_blank" class="truncate-link">
                                    {{ asset($foto_pop_path) }}
                                </a>
                            @else
                                N/A
                            @endif
                        </td>
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
                        <td>
                            @if ($visita->foto_precios)
                                @php
                                    $foto_precios_path = str_replace('public/', 'storage/', $visita->foto_precios);
                                @endphp
                                <a href="{{ asset($foto_precios_path) }}" target="_blank" class="truncate-link">
                                    {{ asset($foto_precios_path) }}
                                </a>
                            @else
                                N/A
                            @endif
                        </td>
                        <td>{{ $visita->valor_factura }}</td>
                        <td>Observación</td>
                        <td>
                            @php
                                $estadoFinal = 'Revisión'; // Valor por defecto

                                if ($visita->estado_id == 3 || $visita->estado_id_agente == 3) {
                                    $estadoFinal = 'Rechazado';
                                } elseif ($visita->estado_id == 1 && $visita->estado_id_agente == 1) {
                                    $estadoFinal = 'Aprobado';
                                }
                            @endphp

                            Estado: {{ $estadoFinal }}
                        </td>
                        <td>{{ $visita->created_at }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>

    </div>
@endsection