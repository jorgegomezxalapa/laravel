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

    public function getSolicitudes ( Request $request ) {
      try {

        $solicitudes = Solicitud::orderBy('id', 'DESC')->with('agente')->with('solicitante')->with('responsable')->with('cliente')->get();

        return response()->json(['response' => $solicitudes],200);

      } catch (Exception $e) {
        return response()->json(['response' => $e],500);

      }
    }

      public function getSolicitud ( Request $request ) {
        try {

          $solicitud = Solicitud::where('id', '=', $request->id)->first();

          return response()->json(['response' => $solicitud],200);

        } catch (Exception $e) {
          return response()->json(['response' => $e],500);

        }
      }

      public function editarSolicitud ( Request $request ) {
        try {
      		DB::beginTransaction();
      		$usuario = Solicitud::where('id', '=', $request->id )->first();

  		   $usuario->fecha = $request->fecha;
  		   $usuario->folio = $request->folio;
  		   $usuario->agente = $request->agente;
  		   $usuario->cliente = $request->cliente;
  		   $usuario->solicitante = $request->solicitante;
  		   $usuario->responsable = $request->responsable;
  		    $usuario->comentario = $request->comentarios;
  		   $usuario->save();
  		    DB::commit();


      	} catch (Exception $e) {
          DB::rollBack();
        		return response()->json(['response' => $e],500);
      	}
        	return response()->json(['response' => true],200);
      }
}
