@extends('layouts.layout')

@section('content')
    <div class="main-historico-registros-container">

        <h2>Implementaciones</h2>
        <table class="styled-table">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Punto</th>
                    <th>Meta Volumen</th>
                    <th>Volumen Acumulado</th>
                    <th>% Cumplimiento</th>
                    <th>Impl. 1</th>
                    <th>Impl. 2</th>
                    <th>Impl. 3</th>
                    <th>Impl. 4</th>
                    <th>Impl. 5</th>
                    <th>Impl. 6</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($pdvs as $key => $pdv)
                    <tr>
                        <td>{{ $key+= 1 }}</td>
                        <td>{{ $pdv->descripcion }}</td>
                        <td>{{ $pdv->vol_prom_mes }}</td>
                        <td>{{ $pdv->volAcum }}</td>
                        <td>{{ number_format(floor(($pdv->volAcum/$pdv->vol_prom_mes) * 100), 0) }} %</td>
                        @foreach ($pdv->implementaciones as $keyImp => $implementacion)
                            <td class="implementaciones">
                                <a href="{{ $implementacion->foto_kit }}" class="no-style-link" target="_blank">X</a>
                            </td>
                        @endforeach

                        @for ($i = 0; $i < 6 - count($pdv->implementaciones); $i++)
                            <td class="implementaciones"></td>
                        @endfor
                    </tr>
                @endforeach
            </tbody>
        </table>

    </div>

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
                        <td>{{ $visita->observaciones ?? 'N/A'  }}</td>
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
