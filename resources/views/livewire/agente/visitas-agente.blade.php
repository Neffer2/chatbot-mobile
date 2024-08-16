<div>
    <h2>AGENTE</h2>
    <table>
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
                        <a href="{{ $visita->foto_pdv }}" target="_blank">
                            <img src="{{ $visita->foto_pdv }}" alt="" height="100">
                        </a>
                    </td>
                    <td>
                        <a href="{{ $visita->foto_fatura }}" target="_blank">
                            <img src="{{ $visita->foto_fatura }}" alt="" height="100">
                        </a>
                    </td>
                    <td>{{ $visita->created_at }}</td>
                    <td>
                        <button wire:click="cambioEstado({{ $visita->id }}, 1)" wire:confirm="¿Estás seguro de APROBAR esta visita?">Aprobar</button>
                        <button wire:click="cambioEstado({{ $visita->id }}, 3)" wire:confirm="¿Estás seguro de RECHAZAR esta visita?">rechazar</button>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <br><br><br><br>

    <input type="text" wire:model.lazy="documento">
    <button wire:click="buscar">Buscar</button>

    <table>
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
                    <td>{{ $visita_user->id}}</td>
                    <td>{{ $visita_user->puntoVenta->descripcion }}</td>
                    <td>
                        <a href="{{ $visita_user->foto_pdv }}" target="_blank">
                            <img src="{{ $visita_user->foto_pdv }}" alt="" height="100">
                        </a>
                    </td>
                    <td>{{ $visita_user->created_at }}</td>
                    <td>{{ $visita_user->estado->descripcion }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
 