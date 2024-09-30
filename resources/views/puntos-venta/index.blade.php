<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="css/styles.css">
    <link rel="stylesheet" href="css/puntos-venta.css">
    <title>Puntos de Venta</title>
</head>

<body>
    <div class="container-puntos-venta">
        <h2>Puntos de Venta</h2>
        <table class="table">
            <thead>
                <tr>
                    <th>Descripción</th>
                    <th>Dirección</th>
                    <th>Barrio</th>
                    <th>Localidad</th>
                    <th>Agente</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($puntosVenta as $punto)
                    <tr>
                        <td>{{ $punto->descripcion }}</td>
                        <td>{{ $punto->direccion }}</td>
                        <td>{{ $punto->barrio }}</td>
                        <td>{{ $punto->localidad }}</td>
                        <td>
                            @if ($punto->agente == 1)
                                RYR
                            @elseif ($punto->agente == 2)
                                Cia Lubricantes
                            @elseif ($punto->agente == 3)
                                Ludelpa
                            @else
                                N/A
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</body>

</html>
