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
  public function getPartidas () {
      try {

        $partidas = Partida::orderBy('partida', 'DESC')->get();

        return response()->json(['response' => $partidas],200);

      } catch (Exception $e) {
        return response()->json(['response' => $e],500);

      }
    }

    public function getPartidasCotizacion (Request $request) {
      try {

        $partidas = Partida::orderBy('partida', 'ASC')->with('producto.segmento')->where('idCotizacion', '=', $request->id)->get();

        return response()->json(['response' => $partidas],200);

      } catch (Exception $e) {
        return response()->json(['response' => $e],500);

      }
    }

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
          $cotizacion = Cotizacion::where('id', '=', $id )->with('solicitud')->with('utilidad')->with('solicitud.agente')->
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

           


         
            return response()->json(['response' => "ok"],200);

        } catch (Exception $e) {
          return response()->json(['response' => $e],500);

        }
      }

      public function savePartidaCotizacion (Request $request) {

        try {
         

          $almacen = new Almacen();
          $almacen->esSolicitud = 1;
          $almacen->esMejora = 0;
          $almacen->idSegmento = ($request->segmento == null || $request->segmento =="null") ? null : $request->segmento;
          $almacen->idEmpleado = $request->idEmpleado;
          $almacen->descripcion = ($request->descripcion == null || $request->descripcion =="null") ? null : $request->descripcion;
          $almacen->unidaddemedida = ($request->unidaddemedida == null || $request->unidaddemedida =="null") ? null : $request->unidaddemedida;
         
          $almacen->cantidad = ($request->cantidad == null || $request->cantidad =="null") ? 0.00 : $request->cantidad;
          $almacen->disponible = 0;
          $almacen->preciodelproveedor = ($request->preciodeproveedor == null || $request->preciodeproveedor =="null") ? null : $request->preciodeproveedor;
          $almacen->marca = ($request->marca == null || $request->marca =="null") ? null : $request->marca;
          $almacen->modelo = ($request->modelo == null || $request->modelo =="null") ? null : $request->modelo;
          $almacen->numerodeserie = ($request->numerodeserie == null || $request->numerodeserie =="null") ? null : $request->numerodeserie;
          $almacen->politicasdegarantia = $request->politicas;
          $almacen->notasdelproducto = ($request->notasdelproducto == null || $request->notasdelproducto =="null") ? null : $request->notasdelproducto;
          if(  isset ( $request->archivo ) ){
                $nombreConcatenado = null;
                foreach($request->archivo as $archivo){
                $nombre = $archivo->getClientOriginalName();
                if($nombreConcatenado != null){
                    $nombreConcatenado = $nombreConcatenado.','.$nombre;
                }else{
                    $nombreConcatenado = $nombre;
                }
                $path = $archivo->storeAs(
                'cotizaciones/'.$request->idCotizacion.'/'.$request->partida,  $nombre
                );
                }
                $almacen->archivosdenotas = $nombreConcatenado;

            }
          $almacen->miniatura = null;

          $almacen->save();

          $partida = new Partida();
          $partida->esMejora = 0;
          $partida->idCotizacion = $request->idCotizacion;
          $partida->idProducto = $almacen->id;
          $partida->partida = $request->partida;
          $partida->descripcion = ($request->descripcion == null || $request->descripcion =="null") ? null : $request->descripcion;
          $partida->unidadmedida = ($request->unidaddemedida == null || $request->unidaddemedida =="null") ? null : $request->unidaddemedida;
          $partida->cantidad = ($request->cantidad == null || $request->cantidad =="null" || $request->cantidad == 0) ? "NO COTIZA" : $request->cantidad;
          $partida->politicas = $request->politicas;
          $partida->disponible = 0;
          $partida->solicitadas = ($request->cantidad == null || $request->cantidad =="null") ? 0.00 : $request->cantidad;
          if ($request->cantidad == null || $request->cantidad =="null" || $request->cantidad == 0) {
            $partida->cantidad = "NO COTIZA";
          }
          
          if ($request->preciodeproveedor == null || $request->preciodeproveedor =="null" || $request->preciodeproveedor == 0) {
            $partida->precioproveedor = "NO COTIZA";
          }

          $partida->marca = ($request->marca == null || $request->marca =="null") ? null : $request->marca;
          $partida->modelo = ($request->modelo == null || $request->modelo =="null") ? null : $request->modelo;
          $partida->numserie = ($request->numerodeserie == null || $request->numerodeserie =="null") ? null : $request->numerodeserie;
            $partida->notasproducto = ($request->notasdelproducto == null || $request->notasdelproducto =="null") ? null : $request->notasdelproducto;

          $partida->ivapartida = intval($request->ivaglobal);
          $partida->iepspartida = intval($request->iepsglobal);
          $partida->utilidadpartida = intval($request->utilidadglobal);



          $partida->importe1 = $request->importe1;
          $partida->utilidadgenerada = $request->utilidadgenerada;
          $partida->preciounitario = $request->preciounitario;
          $partida->importe2 = $request->importe2;
          if ($request->cantidad == null || $request->cantidad =="null" || $request->cantidad == 0) {
            $partida->importe1 = "NO COTIZA";
            $partida->utilidadgenerada = "NO COTIZA";
            $partida->preciounitario = "NO COTIZA";
            $partida->importe2 = "NO COTIZA";
          }
          if ($request->preciodeproveedor == null || $request->preciodeproveedor =="null" || $request->preciodeproveedor == 0) {
            $partida->importe1 = "NO COTIZA";
            $partida->utilidadgenerada = "NO COTIZA";
            $partida->preciounitario = "NO COTIZA";
            $partida->importe2 = "NO COTIZA";
          }

          $partida->save();

          $totales = Partida::where('idCotizacion', '=', $request->idCotizacion)
          ->where('cantidad', '!=', null)
          ->where('cantidad', '!=', "NO COTIZA")
          ->where('precioproveedor', '!=', null)
          ->where('precioproveedor', '!=', "NO COTIZA")
          ->where('importe1', '!=', null)
          ->where('importe1', '!=', "NO COTIZA")
          ->where('utilidadgenerada', '!=', null)
          ->where('utilidadgenerada', '!=', "NO COTIZA")
          ->where('preciounitario', '!=', null)
          ->where('preciounitario', '!=', "NO COTIZA")
          ->where('importe2', '!=', null)
          ->where('importe2', '!=', "NO COTIZA")
          ->get();

          $subtotal = 0;
          $ivatotal = 0;
          $iepstotal = 0;
          $totalfinal = 0;
          foreach ($totales as $partida) {
            $subtotal = round(($subtotal + $partida->importe2), 2);
            $ivapartida = 0;
            $ivapartida = $partida->importe2 * ($partida->ivapartida / 100);
            $ivatotal = round(($ivatotal + $ivapartida), 2);
            $iepspartida = 0;
            $iepspartida = $partida->importe2 * ($partida->iepspartida / 100);
            $iepstotal = round(($iepstotal + $iepspartida), 2);
          }

          $totalfinal = $subtotal + $ivatotal + $iepstotal;

          $final = Cotizacion::where('id', '=', $request->idCotizacion)->first();
          $final->subtotal = $subtotal;
          $final->ivaTotal = $ivatotal;
          $final->iepsTotal = $iepstotal;
          $final->total = $totalfinal;
          $final->save();
         
            return response()->json(['response' => "ok"],200);

        } catch (Exception $e) {
          return response()->json(['response' => $e],500);

        }
      }

      public function mejorarPartida (Request $request) {

        try {
         

          $almacen = new Almacen();
          $almacen->esSolicitud = 1;
          $almacen->esMejora = 1;
          $almacen->idSegmento = ($request->segmento == null || $request->segmento =="null") ? null : $request->segmento;
          $almacen->idEmpleado = $request->idEmpleado;
          $almacen->descripcion = ($request->descripcion == null || $request->descripcion =="null") ? null : $request->descripcion;
          $almacen->unidaddemedida = ($request->unidaddemedida == null || $request->unidaddemedida =="null") ? null : $request->unidaddemedida;
         
          $almacen->cantidad = ($request->cantidad == null || $request->cantidad =="null") ? 0.00 : $request->cantidad;
          
          $almacen->preciodelproveedor = ($request->preciodeproveedor == null || $request->preciodeproveedor =="null") ? null : $request->preciodeproveedor;
          $almacen->marca = ($request->marca == null || $request->marca =="null") ? null : $request->marca;
          $almacen->modelo = ($request->modelo == null || $request->modelo =="null") ? null : $request->modelo;
          $almacen->numerodeserie = ($request->numerodeserie == null || $request->numerodeserie =="null") ? null : $request->numerodeserie;
          $almacen->politicasdegarantia = $request->politicas;
          $almacen->notasdelproducto = ($request->notasdelproducto == null || $request->notasdelproducto =="null") ? null : $request->notasdelproducto;
          if(  isset ( $request->archivo ) ){
                $nombreConcatenado = null;
                foreach($request->archivo as $archivo){
                $nombre = $archivo->getClientOriginalName();
                if($nombreConcatenado != null){
                    $nombreConcatenado = $nombreConcatenado.','.$nombre;
                }else{
                    $nombreConcatenado = $nombre;
                }
                $path = $archivo->storeAs(
                'cotizaciones/'.$request->idCotizacion.'/'.$request->partida,  $nombre
                );
                }
                $almacen->archivosdenotas = $nombreConcatenado;

            }
          $almacen->miniatura = null;

          $almacen->save();

          $partida = new Partida();
          $partida->esMejora = 1;
          $partida->idCotizacion = $request->idCotizacion;
          $partida->idProducto = $almacen->id;
          $partida->partida = $request->partida;
          $partida->descripcion = ($request->descripcion == null || $request->descripcion =="null") ? null : $request->descripcion;
          $partida->unidadmedida = ($request->unidaddemedida == null || $request->unidaddemedida =="null") ? null : $request->unidaddemedida;
          $partida->cantidad = ($request->cantidad == null || $request->cantidad =="null") ? "NO COTIZA" : $request->cantidad;
          $partida->politicas = $request->politicas;
          
          $partida->solicitadas = ($request->cantidad == null || $request->cantidad =="null") ? 0.00 : $request->cantidad;
          if ($request->cantidad == null || $request->cantidad =="null") {
            $partida->cantidad = "NO COTIZA";
          }
          $partida->precioproveedor = ($request->preciodeproveedor == null || $request->preciodeproveedor =="null") ? null : $request->preciodeproveedor;
          if ($request->preciodeproveedor == null || $request->preciodeproveedor =="null") {
            $partida->precioproveedor = "NO COTIZA";
          }

          $partida->marca = ($request->marca == null || $request->marca =="null") ? null : $request->marca;
          $partida->modelo = ($request->modelo == null || $request->modelo =="null") ? null : $request->modelo;
          $partida->numserie = ($request->numerodeserie == null || $request->numerodeserie =="null") ? null : $request->numerodeserie;
            $partida->notasproducto = ($request->notasdelproducto == null || $request->notasdelproducto =="null") ? null : $request->notasdelproducto;

          $partida->ivapartida = intval($request->ivaglobal);
          $partida->iepspartida = intval($request->iepsglobal);
          $partida->utilidadpartida = intval($request->utilidadglobal);



          $partida->importe1 = $request->importe1;
          $partida->utilidadgenerada = $request->utilidadgenerada;
          $partida->preciounitario = $request->preciounitario;
          $partida->importe2 = $request->importe2;
          if ($request->cantidad == null || $request->cantidad =="null") {
            $partida->importe1 = "NO COTIZA";
            $partida->importe2 = "NO COTIZA";
          }
          if ($request->preciodeproveedor == null || $request->preciodeproveedor =="null") {
            $partida->importe1 = "NO COTIZA";
            $partida->utilidadgenerada = "NO COTIZA";
            $partida->preciounitario = "NO COTIZA";
            $partida->importe2 = "NO COTIZA";
          }

          $partida->save();

           
            return response()->json(['response' => "ok"],200);

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

          $almacen =  Almacen::where('id', '=', $request->idProducto)->first();
          
          $almacen->idSegmento = ($request->segmento == null || $request->segmento =="null") ? null : $request->segmento;
          $almacen->descripcion = ($request->descripcion == null || $request->descripcion =="null") ? null : $request->descripcion;
          $almacen->unidaddemedida = ($request->unidaddemedida == null || $request->unidaddemedida =="null") ? null : $request->unidaddemedida;
         
          $almacen->cantidad = ($request->cantidad == null || $request->cantidad =="null") ? 0.00 : $request->cantidad;
          
          $almacen->preciodelproveedor = ($request->preciodeproveedor == null || $request->preciodeproveedor =="null") ? null : $request->preciodeproveedor;
          $almacen->marca = ($request->marca == null || $request->marca =="null") ? null : $request->marca;
          $almacen->modelo = ($request->modelo == null || $request->modelo =="null") ? null : $request->modelo;
          $almacen->numerodeserie = ($request->numerodeserie == null || $request->numerodeserie =="null") ? null : $request->numerodeserie;
          $almacen->politicasdegarantia = $request->politicas;
          $almacen->notasdelproducto = ($request->notasdelproducto == null || $request->notasdelproducto =="null") ? null : $request->notasdelproducto;
          if(  isset ( $request->archivo ) ){
                $nombreConcatenado = null;
                foreach($request->archivo as $archivo){
                $nombre = $archivo->getClientOriginalName();
                if($nombreConcatenado != null){
                    $nombreConcatenado = $nombreConcatenado.','.$nombre;
                }else{
                    $nombreConcatenado = $nombre;
                }
                $path = $archivo->storeAs(
                'cotizaciones/'.$request->idCotizacion.'/'.$request->partida,  $nombre
                );
                }
                $almacen->archivosdenotas = $nombreConcatenado;

            }
          $almacen->miniatura = null;

          $almacen->save();

          $partida =  Partida::where('id', '=', $request->idPartida)->first();;
         
         
          $partida->partida = ($request->partida == null || $request->partida =="null") ? null : $request->partida;
          $partida->descripcion = ($request->descripcion == null || $request->descripcion =="null") ? null : $request->descripcion;
          $partida->unidadmedida = ($request->unidaddemedida == null || $request->unidaddemedida =="null") ? null : $request->unidaddemedida;
          $partida->cantidad = ($request->cantidad == null || $request->cantidad =="null" || $request->cantidad == 0) ? "NO COTIZA" : $request->cantidad;
          $partida->politicas = $request->politicas;
          
          $partida->solicitadas = ($request->cantidad == null || $request->cantidad =="null") ? 0.00 : $request->cantidad;
          
          $partida->precioproveedor = ($request->preciodeproveedor == null || $request->preciodeproveedor =="null" || $request->preciodeproveedor == 0) ? "NO COTIZA" : $request->preciodeproveedor;
          

          $partida->marca = ($request->marca == null || $request->marca =="null") ? null : $request->marca;
          $partida->modelo = ($request->modelo == null || $request->modelo =="null") ? null : $request->modelo;
          $partida->numserie = ($request->numerodeserie == null || $request->numerodeserie =="null") ? null : $request->numerodeserie;
            $partida->notasproducto = ($request->notasdelproducto == null || $request->notasdelproducto =="null") ? null : $request->notasdelproducto;

          $partida->ivapartida = intval($request->ivaglobal);
          $partida->iepspartida = intval($request->iepsglobal);
          $partida->utilidadpartida = intval($request->utilidadglobal);



          $partida->importe1 = $request->importe1;
          $partida->utilidadgenerada = $request->utilidadgenerada;
          $partida->preciounitario = $request->preciounitario;
          $partida->importe2 = $request->importe2;
          if ($request->cantidad == null || $request->cantidad =="null" || $request->cantidad ==0) {
            $partida->importe1 = "NO COTIZA";
            $partida->utilidadgenerada = "NO COTIZA";
            $partida->preciounitario = "NO COTIZA";
            $partida->importe2 = "NO COTIZA";
          }
          if ($request->preciodeproveedor == null || $request->preciodeproveedor =="null" || $request->preciodeproveedor == 0) {
            $partida->importe1 = "NO COTIZA";
            $partida->utilidadgenerada = "NO COTIZA";
            $partida->preciounitario = "NO COTIZA";
            $partida->importe2 = "NO COTIZA";
          }

          $partida->save();
          $totales = Partida::where('idCotizacion', '=', $request->idCotizacion)
          ->where('cantidad', '!=', null)
          ->where('cantidad', '!=', "NO COTIZA")
          ->where('precioproveedor', '!=', null)
          ->where('precioproveedor', '!=', "NO COTIZA")
          ->where('importe1', '!=', null)
          ->where('importe1', '!=', "NO COTIZA")
          ->where('utilidadgenerada', '!=', null)
          ->where('utilidadgenerada', '!=', "NO COTIZA")
          ->where('preciounitario', '!=', null)
          ->where('preciounitario', '!=', "NO COTIZA")
          ->where('importe2', '!=', null)
          ->where('importe2', '!=', "NO COTIZA")
          ->get();


          $subtotal = 0;
          $ivatotal = 0;
          $iepstotal = 0;
          $totalfinal = 0;
          foreach ($totales as $partida) {
            $subtotal = round(($subtotal + $partida->importe2), 2);
            $ivapartida = 0;
            $ivapartida = $partida->importe2 * ($partida->ivapartida / 100);
            $ivatotal = round(($ivatotal + $ivapartida), 2);
            $iepspartida = 0;
            $iepspartida = $partida->importe2 * ($partida->iepspartida / 100);
            $iepstotal = round(($iepstotal + $iepspartida), 2);
          }

          $totalfinal = $subtotal + $ivatotal + $iepstotal;

          $final = Cotizacion::where('id', '=', $request->idCotizacion)->first();
          $final->subtotal = $subtotal;
          $final->ivaTotal = $ivatotal;
          $final->iepsTotal = $iepstotal;
          $final->total = $totalfinal;
          $final->save();


            return response()->json(['response' => "ok"],200);

        } catch (Exception $e) {
          return response()->json(['response' => $e],500);

        }
      }
}
