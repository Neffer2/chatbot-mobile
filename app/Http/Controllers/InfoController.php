<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class InfoController extends Controller
{
    public function getUser($documento){
        
        $user = User::select('id', 'name')->where('documento', $documento)->first();
        return response()->json(['id' => $user->id, 'name' => $user->name]);
    }
}
