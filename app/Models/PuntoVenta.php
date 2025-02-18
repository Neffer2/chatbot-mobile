<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PuntoVenta extends Model
{
    use HasFactory;

    protected $table = 'puntos_venta';

    protected $fillable = [
        'descripcion',
        'asesor_id',
    ];

    public function visitas()
    {
        return $this->hasMany(Visita::class, 'pdv_id');
    }
}
