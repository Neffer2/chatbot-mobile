<div>
    <h2>BACKOFFICE</h2>

    <!-- Existing Table -->
    <table class="styled-table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Agente</th>
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
                <th>Galonaje reportado</th>
                <th>Fecha</th>
                <th>Observaciones</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($visitas as $visita)
                <tr>
                    <td>{{ $visita->id }}</td>
                    <td>
                        @if ($visita->user->empresa_id == 1)
                            RYR
                        @elseif($visita->user->empresa_id == 2)
                            Cia Lubricantes
                        @elseif($visita->user->empresa_id == 3)
                            Ludelpa
                        @else
                            Desconocido
                        @endif
                    </td>
                    <td>
                        {{ $visita->user->name }} <br>
                        {{ $visita->user->documento }}
                    </td>
                    <td>{{ $visita->user->telefono }}</td>
                    <td>
                        {{ $visita->pdv_inscrito ?? 'N/A' }}
                    </td>
                    <td>- {{ $visita->puntoVenta->descripcion }}
                        <br>
                        - {{ $visita ->puntoVenta->num_pdv }}
                    </td>
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
                        <input type="text" wire:model.lazy="observaciones.{{ $visita->id }}"
                            placeholder="Escribe observaciones">
                    </td>
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

    <!-- New Search Table -->
    <h2>Buscar Visitas</h2>
    <form wire:submit.prevent="buscar">
        <input type="text" name="documento" placeholder="Buscar por documento" wire:model="documento">
        <button type="submit">Buscar</button>
    </form>

    <table class="styled-table">
        <thead>
            <tr>
                <th>IDDDD</th>
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
                <th>Estados</th>
                <th>Fecha</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($searchResults as $visita)
                <tr>
                    <td>{{ $visita->id }}</td>
                    <td>
                        {{ $visita->user->name }} <br>
                        {{ $visita->user->documento }}
                    </td>
                    <td>{{ $visita->user->telefono }}</td>
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
                    <td>
                        Backoffice:
                        @if ($visita->estado_id == 1)
                            Aprobado
                        @elseif($visita->estado_id == 2)
                            Revisión
                        @elseif($visita->estado_id == 3)
                            Rechazado
                        @endif
                        <hr>
                        Agente:
                        @if ($visita->estado_id_agente == 1)
                            Aprobado
                        @elseif($visita->estado_id_agente == 2)
                            Revisión
                        @elseif($visita->estado_id_agente == 3)
                            Rechazado
                        @endif
                    </td>
                    <td>{{ $visita->created_at }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

</div>
