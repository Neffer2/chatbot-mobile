<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Visita;
use App\Models\VisitaMobil;
use App\Models\Premio;
use App\Models\RegistroVisita;
use App\Models\PuntoVenta;
use App\Models\PuntoVentaMobil;
use App\Models\Implementacion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        if (!$user) {
            return redirect()->route('login');
        }

        $rol = $user->rol_id;

        switch ($rol) {
            case 1:
            case 2:
                return view('agente.index');
            case 3:
                return view('asesor.index', $this->getMetas($user->id));
            case 4:
                return view('backoffice-terpel.index');
            case 6:
                return view('backoffice-mobil.index');
            default:
                return abort(403, 'Acceso no autorizado');
        }
    }

    public function metas()
    {
        $user = Auth::user();

        if ($user->rol_id != 1) {
            return redirect('/');
        }

        $metas = $this->getMetas(); // Llama al método getMetas sin user_id para obtener datos generales

        return view('agente.metas', [
            'meta_cobertura' => $metas['meta_cobertura'],
            'meta_volumen' => $metas['meta_volumen'],
            'meta_visibilidad' => $metas['meta_visibilidad'],
            'meta_frecuencia' => $metas['meta_frecuencia'],
            'meta_precio' => $metas['meta_precio'],
            'cobertura' => $metas['cobertura'],
            'volumen' => $metas['volumen'],
            'visibilidad' => $metas['visibilidad'],
            'frecuencia' => $metas['frecuencia'],
            'precio' => $metas['precio'],
        ]);
    }

    public function ranking()
    {
        $user = Auth::user();

        if ($user->rol_id != 3) {
            return redirect('/');
        }

        // Obtener los 10 usuarios con más puntos filtrados por empresa_id
        $topUsers = User::where('empresa_id', $user->empresa_id)
            ->orderBy('puntos', 'desc')
            ->take(10)
            ->get();

        // Obtener los puntos de venta
        $topPuntosVenta = Visita::select('pdv_id', DB::raw('count(*) as total_ventas'))
            ->whereNotNull('foto_factura')
            ->where('user_id', $user->id)
            ->groupBy('pdv_id')
            ->orderBy('total_ventas', 'desc')
            ->take(10)
            ->with(['puntoVenta' => function ($query) {
                $query->select('id', 'descripcion');
            }])
            ->get();

        // Añadir la descripción del punto de venta a cada resultado
        $topPuntosVenta->each(function ($visita) {
            $visita->descripcion = $visita->puntoVenta->descripcion ?? 'N/A';
        });

        // Pasar los usuarios a la vista
        return view('asesor.ranking', compact('topUsers', 'topPuntosVenta'));
    }

    public function premios()
    {
        $user = Auth::user();
        $premios = Premio::take(7)->get();

        if ($user->rol_id != 3) {
            return redirect('/');
        }

        $pdv_x_user = PuntoVenta::where('asesor_id', $user->id)->count(); // Puntos de venta asignados
        $pdv_x_user += PuntoVentaMobil::where('asesor_id', $user->id)->count(); // Puntos de venta asignados

        $total_puntos_venta = PuntoVenta::where([
            ['agente', $user->empresa_id]
        ])->count();

        $total_puntos_venta += PuntoVentaMobil::where([
            ['agente', $user->empresa_id]
        ])->count();

        $total_asesores = User::where([
            ['rol_id', 3],
            ['empresa_id', $user->empresa_id]
        ])->count();

        $promedio_pdv = $total_puntos_venta / $total_asesores;

        $premios->map(function ($premio) use ($promedio_pdv, $pdv_x_user) {
            $ajuste_valor_premio = $premio->puntos * ( $pdv_x_user / $promedio_pdv);
            return $premio->puntos = $ajuste_valor_premio;
        });

        // Pasar la vista de premios
        return view('asesor.premios', ['premios' => $premios]);
    }

    public function catalogos()
    {
        $user = Auth::user();

        if ($user->rol_id != 3) {
            return redirect('/');
        }

        return view('asesor.catalogos');
    }

    public function visitas()
    {
        $user = Auth::user();

        if ($user->rol_id != 2) {
            return redirect('/');
        }

        // Pasar la vista de visitas
        return view('agente.visitas');
    }

    public function visitasMobil()
    {
        $user = Auth::user();

        if ($user->rol_id != 2) {
            return redirect('/');
        }

        // Pasar la vista de visitas-mobil
        return view('agente.visitas-mobil');
    }

    public function getMetas($user_id = null)
    {
        if ($user_id) {
            $registro_visita = RegistroVisita::where('user_id', $user_id)->get();
            $pdv_x_user = PuntoVenta::where('asesor_id', $user_id)->get();
            $visitas = Visita::where([
                ['user_id', $user_id],
                ['estado_id', 1],
                ['estado_id_agente', 1]
                ])->get();
        } else {
            $registro_visita = RegistroVisita::all();
            $pdv_x_user = PuntoVenta::all();
        }

        $cobertura = $registro_visita->where('item_meta_id', 4)->count();
        $volumen = $visitas->sum('valor_factura');

        $frecuencia = $registro_visita->where('item_meta_id', 1)->count();
        $visibilidad = $registro_visita->where('item_meta_id', 2)->count();
        $precio = $registro_visita->where('item_meta_id', 5)->count();

        $meta_cobertura = ($pdv_x_user->count());
        $meta_volumen = ($pdv_x_user->sum('vol_prom_mes'));

        $meta_frecuencia = ($pdv_x_user->count() * 6);
        $meta_visibilidad = ($pdv_x_user->count() * 6);
        $meta_precio = ($pdv_x_user->count() * 6);

        return [
            'frecuencia' => $frecuencia,
            'visibilidad' => $visibilidad,
            'volumen' => $volumen,
            'cobertura' => $cobertura,
            'precio' => $precio,
            'meta_frecuencia' => $meta_frecuencia,
            'meta_visibilidad' => $meta_visibilidad,
            'meta_volumen' => $meta_volumen,
            'meta_cobertura' => $meta_cobertura,
            'meta_precio' => $meta_precio
        ];
    }

    public function historicoVentas()
    {
        //Middleware para verificar que el usuario autenticado sea un asesor
        if (Auth::user()->rol_id != 3) {
            return redirect('/');
        }

        // Obtener las visitas del usuario autenticado que cumplen con los criterios especificados
        $visitas = Visita::where('user_id', Auth::id())
            ->whereNotNull('foto_factura')
            ->where('estado_id', 1)
            ->where('estado_id_agente', 1)
            ->get();

        $puntos = PuntoVenta::where('asesor_id', Auth::id())->whereHas('visitas', function ($query) {
            $query->whereNotNull('foto_factura')->where('estado_id', 1)->where('estado_id_agente', 1);
        })->get();

        return view('asesor.historico-ventas', compact('puntos', 'visitas'));
    }

    public function premiosAgente()
    {
        //Middleware para verificar que el usuario autenticado sea un agente u org terpel
        if (Auth::user()->rol_id != 2) {
            return redirect('/');
        }

        $asesores = User::select('id', 'name', 'puntos')->where([
            ['empresa_id', Auth::user()->empresa_id],
            ['rol_id', 3]
        ])->get();

        $premios = Premio::take(7)->get();

        $asesores->map(function ($asesor) use ($premios) {
            foreach ($premios as $key => $premio) {
                $pdv_x_user = PuntoVenta::where('asesor_id', $asesor->id)->count(); // Puntos de venta asignados
                $total_puntos_venta = PuntoVenta::count();
                $total_asesores = User::where('rol_id', 3)->count();
                $promedio_pdv = $total_puntos_venta / $total_asesores;
                $ajuste_valor_premio = $premio->puntos * ( $pdv_x_user / $promedio_pdv);

                $asesor->{"premio_".$premio->premio_id} = $ajuste_valor_premio;
            }
        });

        // Traer empresa_id
        $empresa_id = Auth::user()->empresa_id;

        return view('agente.premios-agente', compact('asesores', 'premios', 'empresa_id'));
    }

    //Historico de registros
    public function historicoRegistros()
    {
        // Middleware para verificar que el usuario autenticado sea un asesor
        if (Auth::user()->rol_id != 3) {
            return redirect('/');
        }

        $pdvs = PuntoVenta::where('asesor_id', Auth::id())->get();
        $pdvs->map(function ($pdv){
            $acumVol = Visita::where('pdv_id', $pdv->id)->sum('valor_factura');
            return $pdv->volAcum = $acumVol;
        });

        $pdvs->map(function ($pdv){
            $implementaciones = Implementacion::where('num_pdv', 'LIKE', "%".$pdv->num_pdv."%")->get();

            return $pdv->implementaciones = $implementaciones;
        });

        // Obtener los registros de visita del usuario autenticado con los datos de la visita
        $registros = Visita::where('user_id', Auth::id())->get();
        return view('asesor.historico-registros', compact('registros', 'pdvs'));
    }

    /* /terminos/terminos-condiciones-fuerza-ventas.pdf */
}
