<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="css/styles.css">
    <link rel="stylesheet" href="css/puntos-venta.css">
    <title>Puntos de Venta Mobil</title>
</head>

<body>
    <div class="container-puntos-venta">
        <h2>Puntos de Venta Mobil</h2>
        <table class="table-puntos-venta">
            <thead>
                <tr>
                    <th>Descripción</th>
                    <th>Dirección</th>
                    <th>Barrio</th>
                    <th>Localidad</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($puntosVentaMobil as $punto)
                    <tr>
                        <td>{{ $punto->descripcion }}</td>
                        <td>{{ $punto->direccion }}</td>
                        <td>{{ $punto->barrio }}</td>
                        <td>{{ $punto->localidad }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</body>

</html>