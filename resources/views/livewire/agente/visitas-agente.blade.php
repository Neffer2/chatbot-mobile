<div class="main-visitas-container">
    <h2>AGENTE - TERPEL</h2>
    <div class="visitas-table-container">
        <table class="visitas-table">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Usuario</th>
                    <th>Punto</th>
                    <th>Foto Punto</th>
                    <th>Foto Factura</th>
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
                        <td>{{ $visita->puntoVenta->descripcion }}</td>
                        <td>
                            @if ($visita->foto_pop)
                                @php
                                    $foto_pop_path = str_replace('public/', 'storage/', $visita->foto_pop);
                                @endphp
                                <a href="{{ asset($foto_pop_path) }}" target="_blank" class="url-truncate">
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
                                <a href="{{ asset($foto_factura_path) }}" target="_blank" class="url-truncate">
                                    {{ asset($foto_factura_path) }}
                                </a>
                            @else
                                N/A
                            @endif
                        </td>
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

    <div class="search-container">
        <input type="text" wire:model.lazy="documento" placeholder="Buscar por documento">
        <button class="btn-search" wire:click="buscar">Buscar</button>
    </div>

    <div class="visitas-table-container">
        <table class="visitas-table">
            <thead>
                <tr>
                    <th>Visita</th>
                    <th>Punto de venta</th>
                    <th>Foto factura</th>
                    <th>Foto Punto</th>
                    <th>Foto precios</th>
                    <th>Fecha</th>
                    <th>Estado</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($visitas_user as $visita_user)
                    <tr>
                        <td>{{ $visita_user->id }}</td>
                        <td>{{ $visita_user->puntoVenta->descripcion }}</td>
                        <td>
                            @if ($visita_user->foto_factura)
                                <a href="{{ asset($visita_user->foto_factura) }}" target="_blank" class="url-truncate">
                                    {{ asset($visita_user->foto_factura) }}
                                </a>
                            @else
                                N/A
                            @endif
                        </td>
                        <td>
                            @if ($visita_user->foto_pop)
                                <a href="{{ asset($visita_user->foto_pop) }}" target="_blank" class="url-truncate">
                                    {{ asset($visita_user->foto_pop) }}
                                </a>
                            @else
                                N/A
                            @endif
                        </td>
                        <td>
                            @if ($visita_user->foto_precios)
                                <a href="{{ asset($visita_user->foto_precios) }}" target="_blank" class="url-truncate">
                                    {{ asset($visita_user->foto_precios) }}
                                </a>
                            @else
                                N/A
                            @endif
                        </td>
                        <td>{{ $visita_user->created_at }}</td>
                        <td>{{ $visita_user->estado->descripcion }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
