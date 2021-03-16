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
// use App\Partida;
// use App\Utilidad;

class AlmacenController extends Controller
{
    public function registro( Request $request ){
      $registro = new Almacen();
      $registro->idEmpleado = $request->idEmpleado;
        $registro->idSegmento = $request->idSegmento;
        $registro->descripcion = $request->descripcion;
        $registro->unidaddemedida = $request->unidaddemedida;
        $registro->cantidad = $request->cantidad;
        $registro->disponible = $request->cantidad;
        $registro->preciodelproveedor = $request->preciodelproveedor;
        $registro->marca = $request->marca;
        $registro->modelo = $request->modelo;
        $registro->numerodeserie = $request->numerodeserie;
        $registro->politicasdegarantia = $request->politicasdegarantia;
        $registro->notasdelproducto = $request->notasdelproducto;
        $registro->archivosdenotas = $request->archivosdenotas;
        $registro->miniatura = $request->miniatura;
        $registro->save();

        $entrada =  new Entrada();
        $entrada->idProducto = $registro->id;
        $entrada->idEmpleado = $request->idEmpleado;
        // $entrada->idCotizacion = $request->valor;
        $entrada->cantidad = $request->cantidad;
        $entrada->concepto = $request->concepto;
        // $entrada->evidencias = $request->valor;
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

    public function getSegmentos( ){
        $segmentos = Segmento::all();
        return response()->json(['response' => $segmentos],200);

    }

    public function getSalidas( ){
        $salidas = Salida::with('producto')->with('producto.segmento')->with('empleado')->get();
        return response()->json(['response' => $salidas],200);

    }

    public function getInventario () {
      $disponible = Almacen::with('segmento')->with('empleado')->get();
      return response()->json(['response' => $disponible],200);

    }

    public function getEntradas () {
      $disponible = Entrada::with('producto')->with('producto.segmento')->with('responsable')->get();
      return response()->json(['response' => $disponible],200);

    }

    public function salidaPartida( Request $request ){
        $salida = new Salida();
        $salida->idProducto = $request->id;
        $salida->idEmpleado = $request->idEmpleado;
        $salida->cantidad = $request->cantidadsalida;
        $salida->concepto = $request->conceptosalida;
        $salida->save();

        $descuento = Almacen::where('id', '=', $request->id)->first();
        $resta = intval($descuento->disponible) - intval($request->cantidadsalida) ;
        $descuento->disponible = $resta;
        $descuento->save();
        return "true";

    }
}
