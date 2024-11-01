<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VisitaMobil extends Model
{
    use HasFactory;
    protected $table = "visitas_mobil";

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
        'valor_galonaje',
        'foto_precios',
        'observaciones',
        'estado_id',
        'estado_id_agente',
    ];

    public function user(){
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function puntoVenta(){
        return $this->belongsTo(PuntoVentaMobil::class, 'pdv_id', 'id');
    }

    public function estado(){
        return $this->belongsTo(Estado::class, 'estado_id', 'id');
    }
    


}
