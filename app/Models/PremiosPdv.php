<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PremiosPdv extends Model
{
    use HasFactory;

    protected $table = 'premios_pdv';

    protected $fillable = [
        'num_venta',
        'descripcion',
        'marca_id',
    ];

    public function marca()
    {
        return $this->belongsTo(Marca::class, 'marca_id', 'id');
    }
}