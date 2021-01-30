<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Solicitud;

class SolicitudController extends Controller
{
    //
    public function create(Request $request)
    {
      try {
        if ($request) {
          DB::beginTransaction();
          $user = new Solicitud();
          $user->fecha = $request->fecha;
          $user->folio = $request->folio;
          $user->agente = $request->agente;
          $user->cliente = $request->cliente;
          $user->solicitante = $request->solicitante;
          $user->responsable = $request->responsable;
          $user->comentario = $request->comentarios;
          $user->save();
          DB::commit();
        }

      } catch (Exception $e) {
      DB::rollBack();
        return response()->json(['response' => $e],500);
      }
    }
}
