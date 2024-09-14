<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Visita;

class VisitasController extends Controller
{
    public function insert(Request $request){
        $visita = new Visita;
        $visita->user_id = $request->user_id;
        $visita->pdv_id = $request->pdv_id;
        $visita->foto_pdv = $request->foto_pdv;
        $visita->segmento = $request->segmento;
        $visita->punto_inscrito = $request->confirma_inscrito;
        $visita->terpel = $request->confirma_terpel;
        $visita->mobil = $request->confirma_mobil;
        $visita->valor_factura = $request->valor_factura;
        $visita->foto_factura = $request->foto_factura;
        $visita->estado_id = 2;
        $visita->estado_id_agente = 2;
        $visita->save();
        
        return response()->json(['status' => 'success']);
    }
}
