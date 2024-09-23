<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'apellido',
        'email',
        'documento',
        'telefono',
        'empresa_id',
        'meta_pdv',
        'password',
        'rol_id'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    public function visitas()
    {
        return $this->hasMany(Visita::class, 'user_id', 'id');
    }


    public function puntaje()
    {
        return $this->puntos;
    }

    public function getFrecuencia(){
        $registro_visita = RegistroVisita::where('user_id', $this->id)->get();
        $frecuencia = $registro_visita->where('item_meta_id', 1)->count();
        return $frecuencia;
    }

    public function getVisibilidad(){
        $registro_visita = RegistroVisita::where('user_id', $this->id)->get();
        $visibilidad = $registro_visita->where('item_meta_id', 2)->count();
        return $visibilidad;
    }

    public function getVolumen(){
        $registro_visita = RegistroVisita::where('user_id', $this->id)->get();
        $volumen = $registro_visita->where('item_meta_id', 3)->count();
        return $volumen;
    }

    public function getCobertura(){
        $registro_visita = RegistroVisita::where('user_id', $this->id)->get();
        $cobertura = $registro_visita->where('item_meta_id', 4)->count();
        return $cobertura;
    }

    public function getPrecio(){
        $registro_visita = RegistroVisita::where('user_id', $this->id)->get();
        $precio = $registro_visita->where('item_meta_id', 5)->count();
        return $precio;
    }
}
