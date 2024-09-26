<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Visita;
use App\Models\RegistroVisita;
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
                return view('backoffice.index');
            default:
                return abort(403, 'Acceso no autorizado');
        }
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
                        ->with(['puntoVenta' => function($query) {
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

        if ($user->rol_id != 3) {
            return redirect('/');
        }

        // Pasar la vista de premios
        return view('asesor.premios');
    }

    public function catalogos(){
        $user = Auth::user(); 
    
        if ($user->rol_id != 3) {
            return redirect('/');
        }
    
        return view('asesor.catalogos');
    }

    public function visitas()
    {
        $user = Auth::user();

        if ($user->rol_id != 1 && $user->rol_id != 2) {
            return redirect('/');
        }

        // Pasar la vista de visitas
        return view('agente.visitas');
    }

    public function getMetas($user_id){
        $registro_visita = RegistroVisita::where('user_id', $user_id)->get();
        $frecuencia = $registro_visita->where('item_meta_id', 1)->count();
        $visibilidad = $registro_visita->where('item_meta_id', 2)->count();
        $volumen = $registro_visita->where('item_meta_id', 3)->count();
        $cobertura = $registro_visita->where('item_meta_id', 4)->count();
        $precio = $registro_visita->where('item_meta_id', 5)->count();

        return [
            'frecuencia' => $frecuencia,
            'visibilidad' => $visibilidad,
            'volumen' => $volumen,
            'cobertura' => $cobertura,  
            'precio' => $precio
        ];
    }
}