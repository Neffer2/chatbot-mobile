<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PuntoVentaMobil extends Model
{
    use HasFactory;

    protected $table = 'puntos_venta_mobil';

    protected $fillable = [
        'descripcion',
        'asesor_id',
    ];

    public function visitas()
    {
        return $this->hasMany(VisitaMobil::class, 'pdv_id');
    }
}