<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Solicitud;
use App\Cotizacion;

class CotizacionController extends Controller
{
    //
    public function getCotizaciones () {
      try {

        $cotizaciones = Cotizacion::orderBy('id', 'DESC')->with('solicitud.agente')->with('solicitud.cliente')->with('solicitud.solicitante')->with('solicitud.responsable')->get();

        return response()->json(['response' => $cotizaciones],200);

      } catch (Exception $e) {
        return response()->json(['response' => $e],500);

      }
    }

      public function getCotizacion (Request $request) {
        try {

          $cotizacion = Cotizacion::where('id', '=', $request->id)->with('solicitud')->with('solicitud.agente')->with('solicitud.cliente')->with('solicitud.solicitante')->with('solicitud.responsable')->first();

          return response()->json(['response' => $cotizacion],200);

        } catch (Exception $e) {
          return response()->json(['response' => $e],500);

        }
      }

      public function iniciarCotizacion (Request $request) {
        try {

          $cotizacion = Cotizacion::where('id', '=', $request->id)->first();
          $cotizacion->idUtilidad = $request->utilidad;
          $cotizacion->save();
          return response()->json(['response' => true],200);

        } catch (Exception $e) {
          return response()->json(['response' => $e],500);

        }
      }
}
