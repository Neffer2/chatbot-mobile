<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Visita extends Model
{
    use HasFactory;
    protected $table = "visitas";

    protected $fillable = [
        'user_id',
        'pdv_id',
        'foto_pop',
        'pdv_inscrito',
        'marca_id',
        'referencias',
        'presentaciones',
        'num_cajas',
        'foto_factura',
        'valor_factura',
        'foto_precios',
        'estado_id',
        'estado_id_agente',
    ];

    public function user(){
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function puntoVenta(){
        return $this->belongsTo(PuntoVenta::class, 'pdv_id', 'id');
    }

    public function estado(){
        return $this->belongsTo(Estado::class, 'estado_id', 'id');
    }
    


}
