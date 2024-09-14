<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\PuntoVenta;
use App\Models\Premio;
use App\Models\Redencion;
use App\Models\Visita;

class InfoController extends Controller
{
    public function getUser($documento)
    {
        $user = User::select('id', 'name', 'puntos')->where('documento', $documento)->first();

        if (!$user) {
            return response()->json(['Usuario no encontrado'], 404);
        }

        return response()->json(['id' => $user->id, 'name' => $user->name,]);
    }

    public function getUserPuntos($id)
    {
        $user = User::find($id);

        if (!$user) {
            return response()->json(['Usuario no encontrado'], 404);
        }

        return response()->json(['puntos' => $user->puntos]);
    }

    public function getPdv($num_pdv, $user_id)
    {
        $pdv = PuntoVenta::select('id', 'descripcion')->where('num_pdv', $num_pdv)->first();

        if (!$pdv) {
            return response()->json(['Punto de venta no encontrado'], 404);
        }

        $punto_inscrito = ($pdv->visitas->where('punto_inscrito', "Si.")->first()) ? 1 : 0;


        $visitas = Visita::where('pdv_id', $pdv->id)
            ->where('user_id', $user_id)->count();

        return response()->json([
            'id' => $pdv->id,
            'punto_inscrito' => $punto_inscrito,
            'descripcion' => $pdv->descripcion,
            'visita' => $visitas + 1
        ]);
    }

    public function getPremiosByMarca($marca_id)
    {
        $premios = Premio::select('id', 'nombre', 'puntos', 'stock')
            ->where('marca_id', $marca_id)
            ->where('stock', '>', 0)
            ->get();

        if ($premios->isEmpty()) {
            return response()->json(['No hay premios disponibles con stock'], 400);
        }

        return response()->json($premios);
    }

    public function redimirPremio($user_id, $premio_id)
    {
        $user = User::find($user_id);
        $premio = Premio::find($premio_id);

        if (!$user || !$premio) {
            return response()->json(['Usuario o premio no encontrado'], 404);
        }

        if ($user->puntos < $premio->puntos) {
            return response()->json(['Puntos insuficientes'], 400);
        }

        if ($premio->stock <= 0) {
            return response()->json(['Stock insuficiente'], 400);
        }

        // Restar puntos del usuario y stock del premio
        $user->puntos -= $premio->puntos;
        $premio->stock -= 1;

        // Guardar los cambios
        $user->save();
        $premio->save();

        // Crear la redención
        Redencion::create([
            'user_id' => $user_id,
            'premio_id' => $premio_id,
        ]);

        return response()->json(['Redención exitosa'], 200);
    }

    public function registrarVisita(Request $request)
    {
        // Validar los datos de entrada
        $validatedData = $request->validate([
            'user_id' => 'integer',
            'pdv_id' => 'integer',
            'foto_pop' => 'string',
            'pdv_inscrito' => 'string',
            'marca_id' => 'integer',
            'referencias' => 'string',
            'presentaciones' => 'string',
            'num_cajas' => 'string',
            'foto_factura' => 'string',
            'valor_factura' => 'string',
        ]);
    
        // Crear la visita
        $visita = Visita::create([
            'user_id' => $validatedData['user_id'],
            'pdv_id' => $validatedData['pdv_id'],
            'foto_pop' => $validatedData['foto_pop'],
            'pdv_inscrito' => $validatedData['pdv_inscrito'],
            'marca_id' => $validatedData['marca_id'],
            'referencias' => $validatedData['referencias'],
            'presentaciones' => $validatedData['presentaciones'],
            'num_cajas' => $validatedData['num_cajas'],
            'foto_factura' => $validatedData['foto_factura'],
            'valor_factura' => $validatedData['valor_factura'],
            'estado_id' => 2,
            'estado_id_agente' => 2,
        ]);
    
        return response()->json(['message' => 'Visita registrada exitosamente', 'visita' => $visita], 201);
    }
}
