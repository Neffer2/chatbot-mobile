<div class="main-visitas-container">
    <h2>AGENTE</h2>
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
                            @if ($visita->foto_pdv)
                                <a href="{{ $visita->foto_pdv }}" target="_blank"
                                    class="url-truncate">{{ $visita->foto_pdv }}</a>
                            @else
                                N/A
                            @endif
                        </td>
                        <td>
                            @if ($visita->foto_factura)
                                <a href="{{ $visita->foto_factura }}" target="_blank"
                                    class="url-truncate">{{ $visita->foto_factura }}</a>
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
                    <th>Foto punto de venta</th>
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
                            @if ($visita_user->foto_pdv)
                                <a href="{{ $visita_user->foto_pdv }}" target="_blank"
                                    class="url-truncate">{{ $visita_user->foto_pdv }}</a>
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
