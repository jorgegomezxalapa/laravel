<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Solicitud;
use App\Cotizacion;
use App\Partida;
use App\Utilidad;

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

          $cotizacion = Cotizacion::where('id', '=', $request->id)->with('utilidad')->with('solicitud')->with('solicitud.agente')->with('solicitud.cliente')->with('solicitud.solicitante')->with('solicitud.responsable')->first();
          $datos = Partida::where('idCotizacion', '=', $request->id)->get();
          $subtotal = 0;
          $iva = 0.16;
          $total = 0;
          $ieps = 0;
          $partidas = 0;
          foreach($datos as $dato){
            $partidas = $partidas + 1;
            $subtotal = $subtotal + floatval($dato->importe2);
          }
          $iva = $iva * $subtotal;
          $total = $subtotal + $iva + $ieps;
          return response()->json(['response' => $cotizacion, 'iva' => $iva, 'subtotal' => $subtotal, 'total' => $total, 'partidas' => $partidas ],200);

        } catch (Exception $e) {
          return response()->json(['response' => $e],500);

        }
      }

      public function saveConfigCotizacion (Request $request) {

        try {

          $cotizacion = Cotizacion::where('id', '=', $request->id)->first();
          $cotizacion->ivaGlobal = $request->ivaGlobal;
          $cotizacion->iepsGlobal = $request->iepsGlobal;
          $cotizacion->utilidadGlobal = $request->utilidadGlobal;
          $cotizacion->estatus = 1;
          $cotizacion->save();

          $utilidad = Utilidad::where('id', '=', $request->utilidadGlobal )->first();



          return response()->json(['response' => true, 'utilidad' => $utilidad],200);

        } catch (Exception $e) {
          return response()->json(['response' => $e],500);

        }
      }

      public function savePartida (Request $request) {

        try {

          $partida = new Partida();
          $partida->partida = $request->partida;
          $partida->descripcion = $request->descripcion;
          $partida->unidadmedida = $request->unidadmedida;
          $partida->cantidad = $request->cantidad;
          $partida->precioproveedor = $request->precioproveedor;
          $partida->utilidaddefault = $request->utilidaddefault;
          $partida->iva = $request->iva;
          $partida->ieps = $request->ieps;
          $partida->importe1 = $request->importe1;
          $partida->utilidadgenerada = $request->utilidadgenerada;
          $partida->preciounitario = $request->preciounitario;
          $partida->importe2 = $request->importe2;
          $partida->idCotizacion = $request->idCotizacion;

          $partida->save();

            $partidas = Partida::orderBy('partida', 'ASC')->where('idCotizacion', '=' ,$request->idCotizacion )->get();
            return response()->json(['response' => $partidas],200);

        } catch (Exception $e) {
          return response()->json(['response' => $e],500);

        }
      }
}
