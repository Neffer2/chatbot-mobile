<?php

namespace App\Livewire\Agente;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Visita;
use App\Models\User;
use App\Models\ItemMeta;
use App\Models\RegistroVisita;
use Illuminate\Support\Facades\Auth;
class VisitasAgente extends Component
{
    use WithPagination;

    // Models
    public $documento;

    // Useful vars
    public $visitas_user = [];

    public function render()
    {
        $user = Auth::user();
        $visitas = Visita::with('user')->wherehas('user', function($query) use ($user){
            $query->where('empresa_id', $user->empresa_id);
        })->where([['estado_id', 1],['estado_id_agente', 2]])->paginate(15);

        return view('livewire.agente.visitas-agente', ['visitas' => $visitas]);
    }

    public function cambioEstado($visita_id, $estado){
        $visita = Visita::find($visita_id);
        $visita->estado_id_agente = $estado;
        $visita->update();

        if ($visita->estado_id_agente == 1){
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

    public function establecerPuntos($visita){
        $num_vista = Visita::where([['user_id', $visita->user_id], ['pdv_id', $visita->pdv_id]])->count();
        $pdv_inscrito = (Visita::where([['user_id', $visita->user_id], ['pdv_id', $visita->pdv_id], ['pdv_inscrito', 'Si.']])->first()) ? true : false;

        if ($num_vista == 1 && !is_null($visita->foto_factura) && $visita->pdv_inscrito == "Si."){
            // Cobertura
            $this->sumPuntos($visita, 4);
            // Volumen
            $this->sumPuntos($visita, 3);
            // Frecuencia
            $this->sumPuntos($visita, 1);

            return redirect()->back()->with('success', 'Visita aprobada correctamente.');
        }elseif ($num_vista > 1 && !is_null($visita->foto_factura) && $pdv_inscrito){
            // Frecuencia
            $this->sumPuntos($visita, 1);
            // Volumen
            $this->sumPuntos($visita, 3);

            return redirect()->back()->with('success', 'Visita aprobada correctamente.');
        }elseif ($num_vista > 1 && !is_null($visita->foto_factura) && $visita->pdv_inscrito == "Si."){
            // Volumen
            $this->sumPuntos($visita, 3);
            // Frecuencia
            $this->sumPuntos($visita, 1);

            return redirect()->back()->with('success', 'Visita aprobada correctamente.');
        }elseif ($num_vista > 1 && !is_null($visita->foto_factura) && !($pdv_inscrito)){
            // Volumen
            $this->sumPuntos($visita, 3);
            // Frecuencia
            $this->sumPuntos($visita, 1);

            return redirect()->back()->with('success', 'Visita aprobada correctamente.');
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
