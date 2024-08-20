<?php

namespace App\Livewire\BackOffice;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Visita;
use App\Models\User;
use App\Models\ItemMeta;
use App\Models\RegistroVisita; 

class Visitas extends Component 
{ 
    use WithPagination; 
    
    // Models
    public $documento;

    // Useful vars
    public $visitas_user = [];

    public function mount(){
        dd("EAAA");
    }

    public function render()
    {   
        $visitas = Visita::where('estado_id', 2)->paginate(15);
        return view('livewire.backoffice.visitas', ['visitas' => $visitas]);
    } 

    public function cambioEstado($visita_id, $estado){
        $visita = Visita::find($visita_id);
        $visita->estado_id = $estado;
        $visita->update();

        if ($visita->estado_id == 1){
            $this->establecerPuntos($visita);
            return redirect()->back()->with('success', 'Visita aprobada correctamente.');
        }else {
            return redirect()->back()->with('success', 'Visita rechazada correctamente.');
        }
    }

    public function buscar(){
        $this->validate([
            'documento' => 'required'
        ]);
        
        $this->visitas_user = User::where('documento', $this->documento)->first()->visitas->where('estado_id', 1);
    }

    // PUNTOS 
    public function establecerPuntos($visita){
        /** INSCRITOS **/
        if (is_null($visita->punto_inscrito) && ($visita->terpel != "Si." && $visita->mobil != "Si.")){
            // Frecuencia 
            $this->sumPuntos($visita, 1);
            //Visibilidad
            $this->sumPuntos($visita, 2);
            
            $visita->estado_id_agente = 1;
            $visita->update();
        }

        /** NO INSCRITOS **/
        if ($visita->punto_inscrito == "No."){
            // Cobertura
            $this->sumPuntos($visita, 4);

            $visita->estado_id_agente = 1;
            $visita->update();
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