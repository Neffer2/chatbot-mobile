<?php

namespace App\Livewire\Back;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\VisitaMobil;
use App\Models\User;
use App\Models\ItemMeta;
use App\Models\RegistroVisitaMobil;

class VisitasMobil extends Component
{
    use WithPagination;

    // Models
    public $documento;
    public $observaciones = [];

    // Useful vars
    public $visitas_user = [];
    public $searchResults = [];

    public function mount()
    {
        // Inicializa las observaciones para cada visita
        $visitas = VisitaMobil::where('estado_id', 2)->get();
        foreach ($visitas as $visita) {
            $this->observaciones[$visita->id] = '';
        }
    }

    public function render()
    {
        $visitas = VisitaMobil::where('estado_id', 2)
            ->orderBy('created_at', 'asc')
            ->paginate(15);
        return view('livewire.back.visitas-mobil', ['visitas' => $visitas]);
    }

    public function buscar()
    {
        $this->searchResults = VisitaMobil::whereHas('user', function ($query) {
            $query->where('documento', 'like', "%{$this->documento}%");
        })->get();
    }

    public function cambioEstado($visita_id, $estado)
    {
        $visita = VisitaMobil::find($visita_id);
        $visita->estado_id = $estado;
        $visita->observaciones = $this->observaciones[$visita_id];
        $visita->update();

        $this->observaciones[$visita_id] = '';
        if ($visita->estado_id == 1) {
            $this->establecerPuntos($visita);
            return redirect()->back()->with('success', 'Visita aprobada correctamente.');
        } else {
            $visita->estado_id_agente = $estado;
            $visita->update();
            return redirect()->back()->with('success', 'Visita rechazada correctamente.');
        }
    }

    // PUNTOS
    public function establecerPuntos($visita)
    {
        $num_vista = VisitaMobil::where([['user_id', $visita->user_id], ['pdv_id', $visita->pdv_id]])->count();
        $pdv_inscrito = (VisitaMobil::where([['user_id', $visita->user_id], ['pdv_id', $visita->pdv_id], ['pdv_inscrito', 'Si.']])->first()) ? true : false;

        if (is_null($visita->foto_factura)) {
            $visita->estado_id_agente = 1;
            $visita->update();
        }

        // Primera visita
        if ($num_vista == 1 && is_null($visita->foto_factura) && $visita->pdv_inscrito == "No.") {
            // Cobertura
            $this->sumPuntos($visita, 4);

            return redirect()->back()->with('success', 'Visita aprobada correctamente.');
        }
        // Visitas 2,3,4
        elseif ($num_vista > 1 && is_null($visita->foto_factura) && !($pdv_inscrito)) {
            // NO SUMA PORQUE ES SU SEGUNDA VISITA SIN VENDER PLAN CHOQUE

            return redirect()->back()->with('success', 'Visita aprobada correctamente.');
        } elseif ($num_vista > 1 && is_null($visita->foto_factura) && $pdv_inscrito && !is_null($visita->foto_pop)) {
            // Frecuencia
            $this->sumPuntos($visita, 1);
            // Visibilidad
            $this->sumPuntos($visita, 2);


            return redirect()->back()->with('success', 'Visita aprobada correctamente.');
        } elseif ($num_vista > 1 && is_null($visita->foto_factura) && $pdv_inscrito && !is_null($visita->foto_precios)) {
            // Frecuencia
            $this->sumPuntos($visita, 1);
            // Precios
            $this->sumPuntos($visita, 5);

            return redirect()->back()->with('success', 'Visita aprobada correctamente.');
        }
    }

    public function registroVisitaMobil($user_id, $visita_id, $item_meta_id, $puntos)
    {
        $registro_visita = new RegistroVisitaMobil;
        $registro_visita->user_id = $user_id;
        $registro_visita->visita_id = $visita_id;
        $registro_visita->item_meta_id = $item_meta_id;
        $registro_visita->puntos = $puntos;
        $registro_visita->save();
    }

    public function sumPuntos($visita, $item)
    {
        $items_metas = ItemMeta::all();
        /*
            1 - Frecuencia
            2 - Visibilidad
            3 - Volumen
            4 - Cobertura
            5 - Precio
        */
        $visita->user->puntos += $items_metas->find($item)->puntos;
        $visita->user->update();
        $this->registroVisitaMobil($visita->user_id, $visita->id, $items_metas->find($item)->id, $items_metas->find($item)->puntos);
    }
}
