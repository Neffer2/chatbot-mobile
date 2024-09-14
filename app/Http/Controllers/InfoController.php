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
        return response()->json(['id' => $pdv->id, 'descripcion' => $pdv->descripcion, 'punto_inscrito' => $punto_inscrito]);

        $visitas = Visita::where('pdv_id', $pdv->id)->where('user_id', $user_id)->count();
        
        return response()->json([
            'id' => $pdv->id,
            'descripcion' => $pdv->descripcion,
            'visitas' => $visitas
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

}
