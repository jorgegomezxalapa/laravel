<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Cliente;

class ClienteController extends Controller
{
  public function create(Request $request)
  {
    try {
      if ($request) {
        DB::beginTransaction();
        $user = new User();
        $user->name = $request->name;
        $user->userName = $request->userName;
        $user->email = $request->email;
        $user->rol = $request->rol;
        $user->telefono = $request->telefono;
        $user->sexo = $request->sexo;
        $user->password = bcrypt($request->password);
        $user->save();
        DB::commit();
      }

    } catch (Exception $e) {
    DB::rollBack();
      return response()->json(['response' => $e],500);
    }
    return response()->json(['response' => 'éxito'],200);
  }
}
