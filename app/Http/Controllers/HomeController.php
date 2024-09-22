<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function index(){
        $rol = Auth::user()->rol_id;
        
        if ($rol == 2){
            return view('agente.index');
            return view('tyc');
        }elseif ($rol == 3){
            return view('asesor.index');
        }
        elseif ($rol == 4){
            return view('backoffice.index');
        }
    }
}
