<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Solicitud;
use App\Cotizacion;
use App\Historial;

class SolicitudController extends Controller
{
    //
    public function create(Request $request)
    {
      try {
        if ($request) {
          DB::beginTransaction();
          $solicitud = new Solicitud();
          $solicitud->fecha = $request->fecha;
          $solicitud->folio = $request->folio;
          $solicitud->agente = $request->agente;
          $solicitud->cliente = $request->cliente;
          $solicitud->solicitante = $request->solicitante;
          $solicitud->responsable = $request->responsable;
          $solicitud->comentario = $request->comentarios;
          $solicitud->urgente = $request->urgente;
          $solicitud->save();

          $sesionHoy = Auth::user();

          $historial = new Historial();
          $historial->idUsuario = $sesionHoy->id;
          $historial->accion = "registro";
          $historial->modulo = "solicitud";
          $historial->descripcion = $sesionHoy->name." registró una nueva solicitud con folio ".$solicitud->folio;

          $historial->save();



          $cotizacion = new Cotizacion();
          $cotizacion->idSolicitud = $solicitud->id;
          $cotizacion->idCliente = $solicitud->cliente;
          $cotizacion->idSolicitante = $solicitud->solicitante;
          $cotizacion->ivaGlobal = 16;
          $cotizacion->iepsGlobal = 0;
        
          $cotizacion->estatus = 0;
          $cotizacion->save();
          DB::commit();
        }

      } catch (Exception $e) {
      DB::rollBack();
        return response()->json(['response' => $e],500);
      }
      	return response()->json(['response' => true],200);
    }

    public function getSolicitudes () {
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
          $usuario->urgente = $request->urgente;
  		   $usuario->save();
  		    DB::commit();


      	} catch (Exception $e) {
          DB::rollBack();
        		return response()->json(['response' => $e],500);
      	}
        	return response()->json(['response' => true],200);
      }
}
