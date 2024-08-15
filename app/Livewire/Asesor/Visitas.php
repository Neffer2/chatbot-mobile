<?php

namespace App\Livewire\Asesor;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Visita;

class Visitas extends Component
{ 
    use WithPagination; 
    
    // Models
    public $documento;

    public function render()
    {   
        $visitas = Visita::where('estado_id', 2)->paginate(15);
        return view('livewire.asesor.visitas', ['visitas' => $visitas]);
    }

    public function buscar(){
        $this->validate([
            'documento' => 'required'
        ]);
        
        
    }
}