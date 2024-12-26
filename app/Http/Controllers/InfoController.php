<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\PuntoVenta;
use App\Models\Premio;
use App\Models\Redencion;
use App\Models\Visita;
use App\Models\PremiosPdv;
use App\Models\PuntoVentaMobil;
use App\Models\VisitaMobil;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

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

        $punto_revision = ($punto_revision = $pdv->visitas->where('estado_id', 2)->count() >= 2) ? 1 : 0;
        $punto_revision = ($punto_revision = $pdv->visitas->where('estado_id_agente', 2)->count() >= 2) ? 1 : 0;

        // Punto de venta inscrito
        $pdv_inscrito = ($pdv->visitas
                        ->where('pdv_inscrito', "Si.")
                        ->where('estado_id', 1)
                        ->where('estado_id_agente', 1)->first()) ? 1 : 0;

        $visitas = Visita::where([
                ['pdv_id', $pdv->id],
                ['estado_id', 1],
                ['estado_id_agente', 1],
                ['user_id', $user_id]
            ])->get();

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
            'num_venta' => $valor_factura_count,
            'punto_revision' => 0
        ]);
    }

    public function getPdvMobil($num_pdv, $user_id){
        $pdvMobil = PuntoVentaMobil::select('id', 'descripcion')->where([
            ['num_pdv', $num_pdv],
            ['asesor_id', $user_id]
        ])->first();

        if (!$pdvMobil) {
            return response()->json(['Punto de venta no encontrado'], 404);
        }

        $punto_revision = ($punto_revision = $pdvMobil->visitas->where('estado_id', 2)->count() >= 2) ? 1 : 0;
        $punto_revision = ($punto_revision = $pdvMobil->visitas->where('estado_id_agente', 2)->count() >= 2) ? 1 : 0;

        // Punto de venta inscrito
        $pdv_inscrito = ($pdvMobil->visitas
                        ->where('pdv_inscrito', "Si.")
                        ->where('estado_id', 1)
                        ->where('estado_id_agente', 1)->first()) ? 1 : 0;

        $visitasMobil = VisitaMobil::where([
                ['pdv_id', $pdvMobil->id],
                ['estado_id', 1],
                ['estado_id_agente', 1],
                ['user_id', $user_id]
            ])->get();

        $valor_factura_count = 0;

        foreach ($visitasMobil as $visita) {
            if (!is_null($visita->valor_factura) && !is_null($visita->foto_factura)) {
                $valor_factura_count++;
            }
        }

        return response()->json([
            'id' => $pdvMobil->id,
            'pdv_inscrito' => $pdv_inscrito,
            'descripcion' => $pdvMobil->descripcion,
            'visita' => $visitasMobil->count() + 1,
            'num_venta' => $valor_factura_count,
            'punto_revision' => 0
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
        $user_puntos = $user->puntos;
        $pdv_x_user = PuntoVenta::where('asesor_id', $user_id)->count(); // Puntos de venta asignados
        $total_puntos_venta = PuntoVenta::count();
        $total_asesores = User::where('rol_id', 3)->count();
        $promedio_pdv = $total_puntos_venta / $total_asesores;
        $ajuste_puntos = $user_puntos * ($promedio_pdv / $pdv_x_user);

        $premio = Premio::where([
            ['premio_id', $premio_id],
            ['empresa_id', $user->empresa_id]
        ])->first();

        $ajuste_valor_premio = $premio->puntos * ( $pdv_x_user / $promedio_pdv);

        if (!$user || !$premio) {
            return response()->json(['Usuario o premio no encontrado'], 404);
        }

        if ($ajuste_puntos < $ajuste_valor_premio) {
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
        $user_puntos = $user->puntos;
        $pdv_x_user = PuntoVenta::where('asesor_id', $user_id)->count(); // Puntos de venta asignados
        $total_puntos_venta = PuntoVenta::count();
        $total_asesores = User::where('rol_id', 3)->count();
        $promedio_pdv = $total_puntos_venta / $total_asesores;
        $ajuste_puntos = $user_puntos * ($promedio_pdv / $pdv_x_user);

        $premio = Premio::where([
            ['premio_id', $premio_id],
            ['empresa_id', $user->empresa_id]
        ])->first();

        $ajuste_valor_premio = $premio->puntos * ( $pdv_x_user / $promedio_pdv);

        if (!$user || !$premio) {
            return response()->json(['Usuario o premio no encontrado'], 404);
        }

        if ($ajuste_puntos < $ajuste_valor_premio) {
            return response()->json(['Puntos insuficientes'], 400);
        }

        if ($premio->stock <= 0) {
            return response()->json(['Stock insuficiente'], 400);
        }

        return response()->json(['Ok'], 200);
    }

    public function registrarVisita(Request $request)
    {
        $foto_pop = (!is_null($request->foto_pop)) ? $this->uploadFile($request->foto_pop) : null;
        $foto_factura = (!is_null($request->foto_factura)) ? $this->uploadFile($request->foto_factura) : null;
        $foto_precios = (!is_null($request->foto_precios)) ? $this->uploadFile($request->foto_precios) : null;

        $visita = Visita::create([
            'user_id' => $request->user_id,
            'pdv_id' => $request->pdv_id,
            'foto_pop' => $foto_pop,
            'pdv_inscrito' => $request->pdv_inscrito,
            'marca_id' => $request->marca_id,
            'referencias' => $request->referencias,
            'presentaciones' => $request->presentaciones,
            'num_cajas' => $request->num_cajas,
            'foto_factura' => $foto_factura,
            'foto_precios' => $foto_precios,
            'valor_factura' => $request->valor_factura,
            'estado_id' => 2,
            'estado_id_agente' => 2,
        ]);

        return response()->json(['message' => 'Visita registrada exitosamente', 'visita' => $visita], 201);
    }

    public function registrarVisitaMobil(Request $request)
    {
        $foto_pop = (!is_null($request->foto_pop)) ? $this->uploadFile($request->foto_pop) : null;
        $foto_factura = (!is_null($request->foto_factura)) ? $this->uploadFile($request->foto_factura) : null;
        $foto_precios = (!is_null($request->foto_precios)) ? $this->uploadFile($request->foto_precios) : null;

        $visitaMobil = VisitaMobil::create([
            'user_id' => $request->user_id,
            'pdv_id' => $request->pdv_id,
            'foto_pop' => $foto_pop,
            'pdv_inscrito' => $request->pdv_inscrito,
            'marca_id' => $request->marca_id,
            'referencias' => $request->referencias,
            'presentaciones' => $request->presentaciones,
            'num_cajas' => $request->num_cajas,
            'foto_factura' => $foto_factura,
            'foto_precios' => $foto_precios,
            'valor_factura' => $request->valor_factura,
            'valor_galonaje' => $request->valor_galonaje,
            'estado_id' => 2,
            'estado_id_agente' => 2,
        ]);

        return response()->json(['message' => 'Visita registrada exitosamente', 'visita' => $visitaMobil], 201);
    }

    public function uploadFile($url){
        $imageContent = file_get_contents($url);

        // Crea un nombre único para la imagen
        $path = "public/photos/".Str::uuid().".jpg";
        Storage::disk('local')->put($path, $imageContent);

        return $path;
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
