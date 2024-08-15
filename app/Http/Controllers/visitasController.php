<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Visita;
use App\Models\ItemMeta;
use App\Models\RegistroVisita;

use function PHPUnit\Framework\isNull;

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
        $visita->foto_fatura = $request->foto_factura;
        $visita->estado_id = 1;
        
        if ($visita->save()){
            $this->sumarPuntos($visita);
        }

        // return response()->json($request->all());
    }

    public function sumarPuntos($visita){
        /** INSCRITOS **/
        if (isNull($visita->punto_inscrito) && ($visita->terpel != "Si." && $visita->mobil != "Si.")){
            // Frecuencia
            $this->sumPuntos($visita, 1);
            // Visibilidad
            $this->sumPuntos($visita, 2);
        }

        if (isNull($visita->punto_inscrito) && ($visita->terpel == "Si." || $visita->mobil == "Si.")){
            // Frecuencia
            $this->sumPuntos($visita, 1);
            // Visibilidad
            $this->sumPuntos($visita, 2);
            // Volumen
            $this->sumPuntos($visita, 3);
        }

        /** NO INSCRITOS **/
        if ($visita->punto_inscrito == "No."){
            // Cobertura
            $this->sumPuntos($visita, 4);
        }

        if ($visita->punto_inscrito == "Si." && ($visita->terpel == "Si." || $visita->mobil == "Si.")){
            // Frecuencia
            $this->sumPuntos($visita, 1);
            // Visibilidad
            $this->sumPuntos($visita, 2);
            // Volumen
            $this->sumPuntos($visita, 3);
            // Cobertura
            $this->sumPuntos($visita, 4);
        }   
    }

    public function registroVisita($user_id, $visita_id, $item_meta_id, $puntos){
        $registro_visita = new RegistroVisita;
        $registro_visita->user_id = $user_id;
        $registro_visita->visita_id = $visita_id;
        $registro_visita->item_meta_id = $item_meta_id;
        $registro_visita->puntos = $puntos;
        $registro_visita->save();
    }

    public function sumPuntos($visita, $item){
        $items_metas = ItemMeta::all();
        /*
            1 - Frecuencia
            2 - Visibilidad
            3 - Volumen
            4 - Cobertura
        */
        $visita->user->puntos += $items_metas->find($item)->puntos;
        $visita->user->update();
        $this->registroVisita($visita->user_id, $visita->id, $items_metas->find($item)->id, $items_metas->find($item)->puntos);
    }
}
