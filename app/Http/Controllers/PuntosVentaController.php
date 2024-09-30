<?php

namespace App\Http\Controllers;

use App\Models\PuntoVenta;
use Illuminate\Http\Request;

class PuntosVentaController extends Controller
{
    public function index()
    {
        $puntosVenta = PuntoVenta::all();
        return view('puntos-venta.index', compact('puntosVenta'));
    }
}