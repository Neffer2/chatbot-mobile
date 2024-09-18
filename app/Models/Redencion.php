<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Redencion extends Model
{
    use HasFactory;

    protected $table = 'redenciones';

    protected $fillable = [
        'premio_id',
        'user_id',
        'direccion',
        'fecha_entrega'
    ];

    public function premio()
    {
        return $this->belongsTo(Premio::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}