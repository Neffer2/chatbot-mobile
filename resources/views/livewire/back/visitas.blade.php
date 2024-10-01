<div>
    <h2>BACKOFFICE</h2>
    <table class="styled-table">
        <thead>
            <tr>
                <th>#</th>
                <th>Usuario</th>
                <th>PDV Inscrito</th>
                <th>Punto</th>
                <th>Referencias</th>
                <th>Presentaciones</th>
                <th>Num cajas</th>
                <th>Foto Punto</th>
                <th>Foto Factura</th>
                <th>Foto Precios</th>
                <th>Valor Factura</th>
                <th>Fecha</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($visitas as $key => $visita)
                <tr>
                    <td>{{ $visita->id }}</td>
                    <td>
                        {{ $visita->user->name }} <br>
                        {{ $visita->user->documento }}
                    </td>
                    <td>
                        {{ $visita->pdv_inscrito }}
                    </td>
                    <td>{{ $visita->puntoVenta->descripcion }}</td>
                    <td>{{ $visita->referencias }}</td>
                    <td>{{ $visita->presentaciones }}</td>
                    <td>{{ $visita->num_cajas }}</td>
                    <td>
                        @if ($visita->foto_pop)
                            <a href="{{ $visita->foto_pop }}" target="_blank" class="truncate-link">
                                {{ $visita->foto_pop }}
                            </a>
                        @else
                            N/A
                        @endif
                    </td>
                    <td>
                        @if ($visita->foto_factura)
                            <a href="{{ $visita->foto_factura }}" target="_blank" class="truncate-link">
                                {{ $visita->foto_factura }}
                            </a>
                        @else
                            N/A
                        @endif
                    </td>
                    <td>
                        @if ($visita->foto_precios)
                            <a href="{{ $visita->foto_precios }}" target="_blank" class="truncate-link">
                                {{ $visita->foto_precios }}
                            </a>
                        @else
                            N/A
                        @endif
                    </td>
                    <td>{{ $visita->valor_factura }}</td>
                    <td>{{ $visita->created_at }}</td>
                    <td>
                        <button class="btn-approve" wire:click="cambioEstado({{ $visita->id }}, 1)" wire:confirm="¿Estás seguro de APROBAR esta visita?">Aprobar</button>
                        <button class="btn-reject" wire:click="cambioEstado({{ $visita->id }}, 3)" wire:confirm="¿Estás seguro de RECHAZAR esta visita?">Rechazar</button>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>