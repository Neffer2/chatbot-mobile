<div>
    <table>
        <thead>
            <tr>
                <th>#</th>
                <th>Usuario</th>
                <th>Punto</th>
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
                    <td>{{ $visita->created_at }}</td>
                    <td>
                        <button wire:click="">Aprobar</button>
                        <button wire:click="">rechazar</button>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <br><br><br><br>

    <input type="text" wire:model.lazy="documento">
    <button wire:click="buscar">Buscar</button>

    
</div>
 