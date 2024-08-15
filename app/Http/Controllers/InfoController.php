<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\PuntoVenta;

class InfoController extends Controller
{
    public function getUser($documento){
        $user = User::select('id', 'name')->where('documento', $documento)->first();
        return response()->json(['id' => $user->id, 'name' => $user->name]);
    }

    public function getPdv($num_pdv){
        $pdv = PuntoVenta::select('id', 'descripcion')->where('num_pdv', $num_pdv)->first();
        $punto_inscrito = ($pdv->visitas->where('punto_inscrito', "Si.")->first()) ? 1 : 0;
        return response()->json(['id' => $pdv->id, 'descripcion' => $pdv->descripcion, 'punto_inscrito' => $punto_inscrito]);   
    }
}