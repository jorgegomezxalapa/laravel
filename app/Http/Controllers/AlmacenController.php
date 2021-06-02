<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Almacen;
use App\Segmento;
use App\Salida;
use App\Entrada;
// use App\Solicitud;
// use App\Cotizacion;
use App\Partida;
// use App\Utilidad;
use Storage;

class AlmacenController extends Controller
{
    public function registro( Request $request ){

      $registro = new Almacen();
      $registro->idEmpleado = intval($request->idEmpleado);
        $registro->idSegmento = $request->idSegmento == 'null' ? null : $request->idSegmento;
        $registro->descripcion = $request->descripcion == 'null' ? null : $request->descripcion;
        $registro->unidaddemedida = $request->unidaddemedida == 'null' ? null : $request->unidaddemedida;
        $registro->cantidad = ($request->cantidad == 'NaN') ? null: intval($request->cantidad);
        $registro->disponible = ($request->cantidad == 'NaN') ? null: intval($request->cantidad);
        $registro->preciodelproveedor = ($request->preciodelproveedor == 'NaN') ? null: intval($request->preciodelproveedor);
        $registro->marca = $request->marca == 'null' ? null : $request->marca;
        $registro->modelo = $request->modelo == 'null' ? null : $request->modelo;
        $registro->numerodeserie = $request->numerodeserie == 'null' ? null : $request->numerodeserie;
        $registro->politicasdegarantia = ($request->politicasdegarantia == 'false') ? 0: 1;
        $registro->notasdelproducto = $request->notasdelproducto == 'null' ? null : $request->notasdelproducto;
        if(  isset ( $request->archivo ) ){
                $nombreConcatenado = null;
                foreach($request->archivo as $archivo){
                $nombre = $archivo->getClientOriginalName();
                if($nombreConcatenado != null){
                    $nombreConcatenado = $nombreConcatenado.','.$nombre;
                }else{
                    $nombreConcatenado = $nombre;
                }
                $carpeta = 'inventario/';
                $path = Storage::putFileAs(
                    $carpeta, $archivo, $nombre
                );
                }
                $registro->archivosdenotas = $nombreConcatenado;

            }
        // $registro->miniatura = $request->miniatura;
        $registro->save();

        $entrada =  new Entrada();
        $entrada->idProducto = $registro->id;
        $entrada->idEmpleado = intval($request->idEmpleado);
        // $entrada->idCotizacion = $request->valor;
        $entrada->cantidad = ($request->cantidad == 'NaN') ? null: intval($request->cantidad);
        $entrada->concepto = ($request->concepto == 'null') ? null: $request->concepto;
        if(  isset ( $request->entrada ) ){
                $nombreConcatenado = null;
                foreach($request->entrada as $archivo){
                $nombre = $archivo->getClientOriginalName();
                if($nombreConcatenado != null){
                    $nombreConcatenado = $nombreConcatenado.','.$nombre;
                }else{
                    $nombreConcatenado = $nombre;
                }
               $carpeta = 'evidenciasEntradas/';
                $path = Storage::putFileAs(
                    $carpeta, $archivo, $nombre
                );
                }
                $entrada->evidencias = $nombreConcatenado;

            }
        $entrada->save();
        return "true";

    }

    public function nuevoSegmento( Request $request ){
        $registro = new Segmento();
        $registro->nombre = $request->nombre;
        $registro->descripcion = $request->descripcion;
        $registro->save();
        return "true";

    }

    public function actualizarIngresoPartida( Request $request ){
      $partida = Partida::where('id', '=', intval($request->idPartida))->first();
      $partida ->disponible = intval($partida->disponible) + intval($request->cantidad);
      $partida->save();

      $producto = Almacen::where('id', '=', intval($request->idProducto))->first();
      $producto->disponible = intval($producto->disponible) + intval($request->cantidad);
      $producto->save();

      $entrada = new Entrada();
      $entrada->idProducto = intval($producto->id);
      $entrada->idEmpleado = intval($request->idEmpleado);
      $entrada->idCotizacion = intval($request->idCotizacion);
      $entrada->cantidad = intval($request->cantidad);
      $entrada->concepto = $request->concepto;
      if(  isset ( $request->archivo ) ){
                $nombreConcatenado = null;
                foreach($request->archivo as $archivo){
                $nombre = $archivo->getClientOriginalName();
                if($nombreConcatenado != null){
                    $nombreConcatenado = $nombreConcatenado.','.$nombre;
                }else{
                    $nombreConcatenado = $nombre;
                }
                $carpeta = 'evidenciasEntradas/';
                $path = Storage::putFileAs(
                    $carpeta, $archivo, $nombre
                );
                }
                $entrada->evidencias = $nombreConcatenado;

            }

      $entrada->save();

      return "exito";
    }

    public function getSegmentos( ){
        $segmentos = Segmento::all();
        return response()->json(['response' => $segmentos],200);

    }

    public function getSalidas( ){
        $salidas = Salida::with('producto')->with('producto.segmento')->with('empleado')->get();
        $array = array();
        foreach($salidas as $item){
        $itemArray = $item->toArray();
        $itemArray['documentos'] = explode(",", $item->evidencias);
        $array[] = $itemArray;
        }
      return response()->json(['response' => $array],200);

    }

    public function getInventario () {
      $disponible = Almacen::with('segmento')->with('empleado')->where('esSolicitud', '=', null)->where('disponible', '>', 0.00)->get();
      return response()->json(['response' => $disponible],200);

    }

    public function getInventarioTotal () {
      $disponible = Almacen::with('segmento')->with('partida')->where('disponible', '>', 0.00)->get();
        $array = array();
        foreach($disponible as $item){
        $itemArray = $item->toArray();
        $itemArray['documentos'] = explode(",", $item->archivosdenotas);
        $array[] = $itemArray;
        }
      return response()->json(['response' => $array],200);

    }

    public function getInventarioSolicitado () {
      $disponible = Partida::where('esMejora', '!=', '1')->with('producto')->with('cotizacion.solicitud')->get();
      return response()->json(['response' => $disponible],200);

    }

    public function getEntradas () {
      $disponible = Entrada::with('producto')->with('producto.segmento')->with('responsable')->get();
       $array = array();
      foreach($disponible as $item){
        $itemArray = $item->toArray();
        $itemArray['documentos'] = explode(",", $item->evidencias);
        $array[] = $itemArray;
        }
      return response()->json(['response' => $array],200);
      return response()->json(['response' => $disponible],200);

    }

    public function salidaPartida( Request $request ){
        $salida = new Salida();
        $salida->idProducto = intval($request->id);
        $salida->idEmpleado = intval($request->idEmpleado);
        $salida->cantidad = intval($request->cantidadsalida);
        $salida->concepto = $request->conceptosalida;
        if(  isset ( $request->archivo ) ){
                $nombreConcatenado = null;
                foreach($request->archivo as $archivo){
                $nombre = $archivo->getClientOriginalName();
                if($nombreConcatenado != null){
                    $nombreConcatenado = $nombreConcatenado.','.$nombre;
                }else{
                    $nombreConcatenado = $nombre;
                }
                $carpeta = 'evidenciasSalidas/';
                $path = Storage::putFileAs(
                    $carpeta, $archivo, $nombre
                );
                }
               $salida->evidencias = $nombreConcatenado;

            }

        $salida->save();

        $descuento = Almacen::where('id', '=', intval($request->id))->first();
        $resta = intval($descuento->disponible) - intval($request->cantidadsalida) ;
        $descuento->disponible = $resta;
        $descuento->save();
        return "true";

    }
}
