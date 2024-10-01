<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\PuntoVenta;
use App\Models\Premio;
use App\Models\Redencion;
use App\Models\Visita;
use App\Models\PremiosPdv;

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

    public function getPdv($num_pdv, $user_id){
        $pdv = PuntoVenta::select('id', 'descripcion')->where([
            ['num_pdv', $num_pdv],
            ['asesor_id', $user_id]
        ])->first();

        if (!$pdv) {
            return response()->json(['Punto de venta no encontrado'], 404);
        }

        // Punto de venta inscrito
        $pdv_inscrito = ($pdv->visitas->where(
            ['pdv_inscrito', "Si."],
            ['estado_id', 1],
        )->first()) ? 1 : 0;

        // Verificar si valor_factura y foto_factura son null
        $visitas = Visita::where([
            ['pdv_id', $pdv->id],
            ['estado_id', 1],
            ['user_id', $user_id]
            ])
            ->get();

        $valor_factura_count = 0;

        foreach ($visitas as $visita) {
            if (!is_null($visita->valor_factura) && !is_null($visita->foto_factura)) {
                $valor_factura_count++;
            }
        }

        return response()->json([
            'id' => $pdv->id,
            'pdv_inscrito' => $pdv_inscrito,
            'descripcion' => $pdv->descripcion,
            'visita' => $visitas->count() + 1,
            'num_venta' => $valor_factura_count
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

    public function redimirPremio($user_id, $premio_id, $direccion, $fecha_entrega)
    {
        $user = User::find($user_id);
        $premio = Premio::where([
            ['premio_id', $premio_id],
            ['empresa_id', $user->empresa_id]
        ])->first();

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

        $user->save();
        $premio->save();

        Redencion::create([
            'user_id' => $user->id,
            'premio_id' => $premio->id,
            'direccion' => $direccion,
            'fecha_entrega' => $fecha_entrega
        ]);

        return response()->json(['Redención exitosa'], 200);
    }

    public function getPremios($user_id, $premio_id) {
        $user = User::find($user_id);
        $premio = Premio::where([
            ['premio_id', $premio_id],
            ['empresa_id', $user->empresa_id]
        ])->first();

        if (!$user || !$premio) {
            return response()->json(['Usuario o premio no encontrado'], 404);
        }

        if ($user->puntos < $premio->puntos) {
            return response()->json(['Puntos insuficientes'], 400);
        }

        if ($premio->stock <= 0) {
            return response()->json(['Stock insuficiente'], 400);
        }

        return response()->json(['Ok'], 200);
    }

    public function registrarVisita(Request $request)
    {
        $visita = Visita::create([
            'user_id' => $request->user_id,
            'pdv_id' => $request->pdv_id,
            'foto_pop' => $request->foto_pop,
            'pdv_inscrito' => $request->pdv_inscrito,
            'marca_id' => $request->marca_id,
            'referencias' => $request->referencias,
            'presentaciones' => $request->presentaciones,
            'num_cajas' => $request->num_cajas,
            'foto_factura' => $request->foto_factura,
            'foto_precios' => $request->foto_precios,
            'valor_factura' => $request->valor_factura,
            'estado_id' => 2,
            'estado_id_agente' => 2,
        ]);

        return response()->json(['message' => 'Visita registrada exitosamente', 'visita' => $visita], 201);
    }

    public function getPremioByNumVisita($num_visita)
    {
        $premio = PremiosPdv::where('num_venta', $num_visita)->first();

        if (!$premio) {
            return response()->json(['Premio no encontrado'], 404);
        } else {
            return response()->json([$premio->descripcion], 200);
        }

    }
}
