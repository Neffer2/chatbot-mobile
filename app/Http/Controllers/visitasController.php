<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class visitasController extends Controller
{
    public function insert(Request $request){
        return response()->json($request->all());
    }
}
