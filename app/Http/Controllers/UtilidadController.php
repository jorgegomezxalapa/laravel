<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Utilidad;
use App\Cotizacion;
use App\Historial;


class UtilidadController extends Controller
{
    //
    public function createUtilidad(Request $request)
    {
      try {
        if ($request) {
          DB::beginTransaction();
          $utilidad = new Utilidad();
          $utilidad->descripcion = $request->descripcion;
          $utilidad->porcentaje = floatval($request->porcentaje);
          $utilidad->save();

          $sesionHoy = Auth::user();

          $historial = new Historial();
          $historial->idUsuario = $sesionHoy->id;
          $historial->accion = "registro";
          $historial->modulo = "tipo de venta";
          $historial->descripcion = $sesionHoy->name." registró el tipo de venta con utilidad del ".$utilidad->porcentaje."%";

          $historial->save();
          DB::commit();
        }

      } catch (Exception $e) {
      DB::rollBack();
        return response()->json(['response' => $e],500);
      }
        return response()->json(['response' => true],200);
    }

    public function getUtilidades()
    {
      try {
        $utilidades = Utilidad::orderBy('id', 'DESC')->get();
          return response()->json(['response' => $utilidades],200);
      } catch (\Exception $e) {
        return response()->json(['response' => $e],500);

      }

    }

    public function getUtilidad (Request $request) {
      try {

        $utilidad = Utilidad::where('id', '=', $request->id )->first();

        return response()->json(['response' => $utilidad],200);

      } catch (Exception $e) {
        return response()->json(['response' => $e],500);

      }
    }

    public function editarUtilidad ( Request $request ) {

      try {
        DB::beginTransaction();
        $utilidad = Utilidad::where('id', '=', $request->id )->first();

       $utilidad->descripcion = $request->descripcion;
       $utilidad->porcentaje = $request->porcentaje;

       $utilidad->save();
        DB::commit();


      } catch (Exception $e) {
        DB::rollBack();
          return response()->json(['response' => $e],500);
      }
        return response()->json(['response' => true],200);
    }

    public function setTipoVenta (Request $request) {
      try {

        $cotizacion = Cotizacion::where('id', '=', $request->id )->first();
        $cotizacion->utilidadGlobal = intval($request->utilidad);
        $cotizacion->save();
        return response()->json(['response' =>'éxito'],200);

      } catch (Exception $e) {
        return response()->json(['response' => $e],500);

      }
    }
}
