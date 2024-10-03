<div>
    <h2>BACKOFFICE</h2>
    <table class="styled-table">
        <thead>
            <tr>
                <th>#</th>
                <th>Usuario</th>
                <th>Telefono</th>
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
            @foreach ($visitas as $index => $visita)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>
                        {{ $visita->user->name }} <br>
                        {{ $visita->user->documento }}
                    </td>
                    <td>{{ $visita->user->telefono }}</td>
                    <td>
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
                    <td>{{ $visita->created_at }}</td>
                    <td>
                        <button class="btn-approve" wire:click="cambioEstado({{ $visita->id }}, 1)"
                            wire:confirm="¿Estás seguro de APROBAR esta visita?">Aprobar</button>
                        <button class="btn-reject" wire:click="cambioEstado({{ $visita->id }}, 3)"
                            wire:confirm="¿Estás seguro de RECHAZAR esta visita?">Rechazar</button>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>