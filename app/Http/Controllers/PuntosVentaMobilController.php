<?php

namespace App\Http\Controllers;
use App\Models\PuntoVentaMobil;
use Illuminate\Http\Request;

class PuntosVentaMobilController extends Controller
{
    public function index()
    {
        $puntosVentaMobil = PuntoVentaMobil::all();
        return view('puntos-venta-mobil.index', compact('puntosVentaMobil'));
    }
}
