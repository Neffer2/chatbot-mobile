<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function index(){
        $user = Auth::user();

        if (!$user) {
            return redirect()->route('login');
        }

        $rol = $user->rol_id;

        switch ($rol) {
            case 2:
                return view('agente.index');
            case 3:
                return view('asesor.index');
            case 4:
                return view('backoffice.index');
            default:
                return abort(403, 'Acceso no autorizado');
        }
    }

    public function ranking(){
        $user = Auth::user();

        if ($user->rol_id != 3) {
            return redirect('/');
        }

        // Obtener los 10 usuarios con más puntos
        $topUsers = User::orderBy('puntos', 'desc')->take(10)->get();

        // Pasar los usuarios a la vista
        return view('asesor.ranking', compact('topUsers'));
    }
}