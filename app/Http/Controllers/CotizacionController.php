<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Solicitud;
use App\Cotizacion;
use App\Partida;
use App\Utilidad;
use App\Almacen;

class CotizacionController extends Controller
{
    //
    public function getSolicitadas () {
      try {

        $cotizaciones = Cotizacion::orderBy('id', 'DESC')->with('solicitud')->with('solicitud.agente')->with('solicitud.cliente')->with('solicitud.solicitante')->with('solicitud.responsable')->where('estatus', '=', 0)->get();

        return response()->json(['response' => $cotizaciones],200);

      } catch (Exception $e) {
        return response()->json(['response' => $e],500);

      }
    }

    public function getProceso () {
      try {

        $cotizaciones = Cotizacion::orderBy('id', 'DESC')->with('solicitud')->with('solicitud.agente')->with('solicitud.cliente')->with('solicitud.solicitante')->with('solicitud.responsable')->where('estatus', '=', 1)->with('partidas')->get();

        return response()->json(['response' => $cotizaciones],200);

      } catch (Exception $e) {
        return response()->json(['response' => $e],500);

      }
    }

    public function getCotizadas () {
      try {

        $cotizaciones = Cotizacion::orderBy('id', 'DESC')->with('solicitud')->with('solicitud.agente')->with('solicitud.cliente')->with('solicitud.solicitante')->with('solicitud.responsable')->where('estatus', '=', 2)->with('partidas')->get();

        return response()->json(['response' => $cotizaciones],200);

      } catch (Exception $e) {
        return response()->json(['response' => $e],500);

      }
    }

    public function getAlmacen () {
      try {

        $partidas = Partida::orderBy('id', 'DESC')->get();

        return response()->json(['response' => $partidas],200);

      } catch (Exception $e) {
        return response()->json(['response' => $e],500);

      }
    }

    public function getAlmacenSolicitadas () {
      try {

        $partidas = Partida::orderBy('id', 'DESC')->where('solicitadas', '!=', null)->with('cotizacion')->with('cotizacion.solicitud')->get();

        return response()->json(['response' => $partidas],200);

      } catch (Exception $e) {
        return response()->json(['response' => $e],500);

      }
    }

    public function actualizarPInventario (Request $request) {
      try {

        $partidas = Partida::where('id', '=', $request->id)->first();
        $partidas->disponible = $request->sumar;
        $partidas->solicitadas = $request->restar;
        $partidas->save();

        return response()->json(['response' => "ok"],200);

      } catch (Exception $e) {
        return response()->json(['response' => $e],500);

      }
    }

    public function getAlmacenDisponibles () {
      try {

        $partidas = Partida::orderBy('id', 'DESC')->where('solicitadas', '=', null)->get();

        return response()->json(['response' => $partidas],200);

      } catch (Exception $e) {
        return response()->json(['response' => $e],500);

      }
    }

      public function getCotizacion (Request $request) {
        try {
          $id = $request->id;
          $cotizacion = Cotizacion::where('id', '=', $id )->with('solicitud')->with('solicitud.agente')->
          with('solicitud.cliente')->with('solicitud.solicitante')
          ->with('solicitud.responsable')->with('partidas')
          ->first();

        return response()->json(['response' => $cotizacion],200);

        } catch (Exception $e) {
          return response()->json(['response' => $e],500);

        }
      }

      public function iniciarCotizacion (Request $request) {
        try {

          $cotizacion = Cotizacion::where('id', '=', $request->id)->first();
          $cotizacion->estatus = 1;
          $cotizacion->save();


          return response()->json(['response' => $cotizacion],200);

        } catch (Exception $e) {
          return response()->json(['response' => $e],500);

        }
      }

      public function setIvaCotizacion (Request $request) {
        try {

          $cotizacion = Cotizacion::where('id', '=', $request->id)->first();
          $cotizacion->ivaGlobal = floatval ($request->iva);
          $cotizacion->save();


          return response()->json(['response' => $cotizacion],200);

        } catch (Exception $e) {
          return response()->json(['response' => $e],500);

        }
      }

      public function setIepsCotizacion (Request $request) {
        try {

          $cotizacion = Cotizacion::where('id', '=', $request->id)->first();
          $cotizacion->iepsGlobal = floatval ($request->ieps);
          $cotizacion->save();


          return response()->json(['response' => $cotizacion],200);

        } catch (Exception $e) {
          return response()->json(['response' => $e],500);

        }
      }

      public function saveConfigCotizacion (Request $request) {

        try {

          $cotizacion = Cotizacion::where('id', '=', $request->id)->with('utilidad')->first();
          $cotizacion->ivaGlobal = $request->ivaGlobal;
          $cotizacion->iepsGlobal = $request->iepsGlobal;
          $cotizacion->utilidadGlobal = $request->utilidadGlobal;
          $cotizacion->estatus = 1;
          $cotizacion->save();


          return response()->json(['response' => true, 'cotizacion' => $cotizacion],200);

        } catch (Exception $e) {
          return response()->json(['response' => $e],500);

        }
      }

      public function savePartida (Request $request) {

        try {

          $almacen = new Almacen();
          $almacen->esSolicitud = 1;
          $almacen->idSegmento = null;
          $almacen->idEmpleado = null;
          $almacen->descripcion = $request->descripcion;
          $almacen->unidaddemedida = $request->unidadmedida;
          $almacen->cantidad = $request->cantidad;
          $almacen->disponible = 0;
          $almacen->preciodelproveedor = $request->precioproveedor;
          $almacen->marca = $request->marca;
          $almacen->modelo = $request->modelo;
          $almacen->numerodeserie = $request->numserie;
          $almacen->politicasdegarantia = $request->politicas;
          $almacen->notasdelproducto = $request->notasproducto;
          $almacen->archivosdenotas = null;
          $almacen->miniatura = null;
          $almacen->save();

          $partida = new Partida();
            $partida->idCotizacion = $request->idCotizacion;
            $partida->idProducto = $almacen->id;
          $partida->partida = $request->partida;
          $partida->descripcion = $request->descripcion;
          $partida->unidadmedida = $request->unidadmedida;
          $partida->cantidad = $request->cantidad;
          $partida->politicas = $request->politicas;
          $partida->disponible = 0;
          $partida->solicitadas = $request->cantidad;
          if ($request->cantidad == null) {
            $partida->cantidad = "NO COTIZA";
          }
          $partida->precioproveedor = $request->precioproveedor;
          if ($request->precioproveedor == null) {
            $partida->precioproveedor = "NO COTIZA";
          }

          $partida->marca = $request->marca;
          $partida->modelo = $request->modelo;
          $partida->numserie = $request->numserie;
            $partida->notasproducto = $request->notasproducto;

          $partida->ivapartida = $request->ivapartida;
          $partida->iepspartida = $request->iepspartida;
          $partida->utilidadpartida = $request->utilidadpartida;



          $partida->importe1 = $request->importe1;
          $partida->utilidadgenerada = $request->utilidadgenerada;
          $partida->preciounitario = $request->preciounitario;
          $partida->importe2 = $request->importe2;
          if ($request->cantidad == null) {
            $partida->importe1 = "NO COTIZA";
            $partida->importe2 = "NO COTIZA";
          }
          if ($request->precioproveedor == null) {
            $partida->importe1 = "NO COTIZA";
            $partida->utilidadgenerada = "NO COTIZA";
            $partida->preciounitario = "NO COTIZA";
            $partida->importe2 = "NO COTIZA";
          }




          $partida->save();

            $partidas = Partida::orderBy('partida', 'ASC')->where('idCotizacion', '=' ,$request->idCotizacion )->get();
            $iva = 0;
            $ieps = 0;
            $subtotal = 0;
            $total = 0;


            foreach($partidas as $partida){

            $subtotal = intval($subtotal) + intval($partida->importe2);
            $iva = intval($iva) + ( intval($partida->importe2) * intval(intval($partida->ivapartida)/100));
            $ieps = intval($ieps) + ( intval($partida->importe2) * (intval($partida->iepspartida)/100));
            }

            $total = $subtotal + $iva + $ieps;


            $cotizacion = Cotizacion::where('id', '=', $request->idCotizacion)->first();

            $cotizacion->ivaTotal = $iva;
            $cotizacion->iepsTotal = $ieps;
            $cotizacion->subtotal = $subtotal;
            $cotizacion->total = $total;
            $cotizacion->save();

            return response()->json(['response' => $partidas, 'cotizacion'=>$cotizacion],200);

        } catch (Exception $e) {
          return response()->json(['response' => $e],500);

        }
      }

      public function saveInventario (Request $request) {

        try {


          $partida = new Partida();

          $partida->descripcion = $request->descripcion;
          $partida->unidadmedida = $request->unidadmedida;
          $partida->cantidad = $request->cantidad;

          $partida->precioproveedor = $request->precioproveedor;

          $partida->marca = $request->marca;
          $partida->modelo = $request->modelo;
          $partida->numserie = $request->numserie;
          $partida->notasproducto = $request->notasproducto;
          $partida->politicas = $request->politicas;

          $partida->disponible = $request->cantidad;




          $partida->save();

            $partidas = Partida::orderBy('partida', 'ASC')->get();


            return response()->json(['response' => $partidas],200);

        } catch (Exception $e) {
          return response()->json(['response' => $e],500);

        }
      }

      public function editarPartida (Request $request) {

        try {


          $partida = Partida::where('id', '=', $request->idPartida)->first();
          $partida->idCotizacion = $request->idCotizacion;
          $partida->partida = $request->partida;
          $partida->descripcion = $request->descripcion;
          $partida->unidadmedida = $request->unidadmedida;
          $partida->cantidad = $request->cantidad;
          if ($request->cantidad == null) {
            $partida->cantidad = "NO COTIZA";
          }
          $partida->precioproveedor = $request->precioproveedor;
          if ($request->precioproveedor == null) {
            $partida->precioproveedor = "NO COTIZA";
          }

          $partida->marca = $request->marca;
          $partida->modelo = $request->modelo;
          $partida->numserie = $request->numserie;
            $partida->notasproducto = $request->notasproducto;

          $partida->ivapartida = $request->ivapartida;
          $partida->iepspartida = $request->iepspartida;
          $partida->utilidadpartida = $request->utilidadpartida;



          $partida->importe1 = $request->importe1;
          $partida->utilidadgenerada = $request->utilidadgenerada;
          $partida->preciounitario = $request->preciounitario;
          $partida->importe2 = $request->importe2;
          if ($request->cantidad == null) {
            $partida->importe1 = "NO COTIZA";
            $partida->importe2 = "NO COTIZA";
          }
          if ($request->precioproveedor == null) {
            $partida->importe1 = "NO COTIZA";
            $partida->utilidadgenerada = "NO COTIZA";
            $partida->preciounitario = "NO COTIZA";
            $partida->importe2 = "NO COTIZA";
          }




          $partida->save();

            $partidas = Partida::orderBy('partida', 'ASC')->where('idCotizacion', '=' ,$request->idCotizacion )->get();

            $iva = 0;
            $ieps = 0;
            $subtotal = 0;
            $total = 0;

            foreach($partidas as $partida){

            $subtotal = intval($subtotal) + intval($partida->importe2);
            $iva = intval($iva) + ( intval($partida->importe2) * intval(intval($partida->ivapartida)/100));
            $ieps = intval($ieps) + ( intval($partida->importe2) * (intval($partida->iepspartida)/100));
            }
            $total = $subtotal + $iva + $ieps;

            $cotizacion = Cotizacion::where('id', '=', $request->idCotizacion)->first();
            $cotizacion->ivaTotal = $iva;
            $cotizacion->iepsTotal = $ieps;
            $cotizacion->subtotal = $subtotal;
            $cotizacion->total = $total;
            $cotizacion->save();


            return response()->json(['response' => $partidas, 'cotizacion'=>$cotizacion],200);

        } catch (Exception $e) {
          return response()->json(['response' => $e],500);

        }
      }
}
