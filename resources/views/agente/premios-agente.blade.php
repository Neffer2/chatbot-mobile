@extends('layouts.layout')
@section('content')
    <div class="main-visitas-container">
        <h2>PREMIOS POR ASESOR</h2>
        <div class="visitas-table-container">
            <table class="visitas-table">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Asesor</th>
                        <th>Viaje Cartagena</th>
                        <th>Scooter </th>
                        <th>Smart TV 55"</th>
                        <th>Morral</th>
                        <th>Parlante Bluetooth</th>
                        <th>Netflix</th>
                        <th>Spotify</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($asesores as $key => $asesor)
                        <tr>
                           <td>{{ $key+=1 }}</td>
                           <td style="font-weight: bold;">
                                {{ $asesor->name }} <br>
                                {{ $asesor->puntos }}
                           </td>
                           <td>
                                {{ number_format(floor($asesor->premio_1), 0) }}
                           </td>
                           <td>
                                {{ number_format(floor($asesor->premio_2), 0) }}
                           </td>
                           <td>
                                {{ number_format(floor($asesor->premio_3), 0) }}
                           </td>
                           <td>
                                {{ number_format(floor($asesor->premio_4), 0) }}
                           </td>
                           <td>
                                {{ number_format(floor($asesor->premio_5), 0) }}
                           </td>
                           <td>
                                {{ number_format(floor($asesor->premio_6), 0) }}
                           </td>
                           <td>
                                {{ number_format(floor($asesor->premio_7), 0) }}
                           </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
