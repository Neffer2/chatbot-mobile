<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Visita extends Model
{
    use HasFactory;
    protected $table = "visitas";

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
