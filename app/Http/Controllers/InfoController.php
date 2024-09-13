<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\PuntoVenta;
use App\Models\Premio;
use App\Models\Redencion;

class InfoController extends Controller
{
    public function getUser($documento)
    {
        $user = User::select('id', 'name')->where('documento', $documento)->first();
        return response()->json(['id' => $user->id, 'name' => $user->name]);
    }

    public function getUserPuntos($id)
    {
        $user = User::find($id);
        return response()->json(['puntos' => $user->puntos]);
    }

    public function getPdv($num_pdv)
    {
        $pdv = PuntoVenta::select('id', 'descripcion')->where('num_pdv', $num_pdv)->first();
        $punto_inscrito = ($pdv->visitas->where('punto_inscrito', "Si.")->first()) ? 1 : 0;
        return response()->json(['id' => $pdv->id, 'descripcion' => $pdv->descripcion, 'punto_inscrito' => $punto_inscrito]);
    }

    public function getPremiosByMarca($marca_id)
    {
        $premios = Premio::select('id', 'nombre', 'puntos', 'stock')
            ->where('marca_id', $marca_id)
            ->where('stock', '>', 0)
            ->get();
        return response()->json($premios);
    }

    public function redimirPremio($user_id, $premio_id)
    {
        $user = User::find($user_id);
        $premio = Premio::find($premio_id);

        if (!$user || !$premio) {
            return response()->json(['error' => 'Usuario o premio no encontrado'], 404);
        }

        if ($user->puntos < $premio->puntos) {
            return response()->json(['error' => 'Puntos insuficientes'], 400);
        }

        if ($premio->stock <= 0) {
            return response()->json(['error' => 'Stock insuficiente'], 400);
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

        return response()->json(['message' => 'Redención exitosa'], 200);
    }
}
