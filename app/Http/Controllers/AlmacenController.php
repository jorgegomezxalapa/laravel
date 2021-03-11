<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Almacen;
use App\Segmento;
// use App\Solicitud;
// use App\Cotizacion;
// use App\Partida;
// use App\Utilidad;

class AlmacenController extends Controller
{
    public function registro( Request $request ){
      $registro = new Almacen();

        $registro->idSegmento = $request->idSegmento;
        $registro->descripcion = $request->descripcion;
        $registro->unidaddemedida = $request->unidaddemedida;
        $registro->cantidad = $request->cantidad;
        $registro->preciodelproveedor = $request->preciodelproveedor;
        $registro->marca = $request->marca;
        $registro->modelo = $request->modelo;
        $registro->numerodeserie = $request->numerodeserie;
        $registro->politicasdegarantia = $request->politicasdegarantia;
        $registro->notasdelproducto = $request->notasdelproducto;
        $registro->archivosdenotas = $request->archivosdenotas;
        $registro->miniatura = $request->miniatura;

        $registro->save();
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
}
