<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Solicitante;
use App\Cliente;
use App\Solicitud;
use App\Venta;
use App\Cotizacion;
use App\RazonSocial;


class SolicitantesController extends Controller
{
    //

  public function filtrarBusquedaSolicitantes(Request $request){
          
          $mes = $request->mes;
          $anio = $request->anio;

         $solicitantes = Solicitante::orderBy('id', 'DESC')->get();
         $clientes = Cliente::orderBy('id', 'DESC')->get();

        $tablita = [];
        foreach ($solicitantes as $solicitante) {

          foreach($clientes as $cliente){

            $solicitudes = Solicitud::where('solicitante', '=', $solicitante->id)
            ->where('cliente', '=', $cliente->id)
             ->whereYear('created_at', $anio)
            ->whereMonth('created_at', $mes)->get();
       
            

            $cotizaciones = Cotizacion::where('idSolicitante', '=', $solicitante->id)
             ->where('idCliente', '=', $cliente->id)
            ->whereYear('created_at', $anio)
            ->whereMonth('created_at', $mes)->get();
            

             $ventas = Venta::where('idSolicitante', '=', $solicitante->id)
             ->where('idCliente', '=', $cliente->id)
            ->whereYear('created_at', $anio)
            ->whereMonth('created_at', $mes)->get();

            $valor =  [  'nombre' => $solicitante->nombre,'razonsocial' => $cliente->razonSocial,  'solicitudes' => $solicitudes, 'cotizaciones' => $cotizaciones, 'ventas' => $ventas ];

            array_push($tablita, $valor);
          }


    }

    return response()->json(['response' => $tablita],200);
  }

  public function filtrarBusquedaRazones(Request $request){
   
          $anio = $request->anio;
          $mes = $request->mes;
         $razones = RazonSocial::orderBy('id', 'DESC')->get();
         $tablita = [];

         foreach($razones as $razon){

          $solicitudes = Solicitud::where('razonSocial', '=', $razon->id) ->whereYear('created_at', $anio)
            ->whereMonth('created_at', $mes)->get();

          $cotizaciones = Cotizacion::where('razonSocial', '=', $razon->id)->whereYear('created_at', $anio)
            ->whereMonth('created_at', $mes)->get();
          $ventas = Venta::where('razonSocial', '=', $razon->id) ->whereYear('created_at', $anio)
            ->whereMonth('created_at', $mes)->get();

          $valor =  [  'nombre' => $razon->nombre,'solicitudes' => $solicitudes,  'cotizaciones' => $cotizaciones, 'ventas' => $ventas ];

            array_push($tablita, $valor);

         }
         

        
        

            
          

    return response()->json(['response' => $tablita],200);
  }

  public function getRazonesDasboard(){
   

         $razones = RazonSocial::orderBy('id', 'DESC')->get();
         $tablita = [];

         foreach($razones as $razon){

          $solicitudes = Solicitud::where('razonSocial', '=', $razon->id)->get();
          $cotizaciones = Cotizacion::where('razonSocial', '=', $razon->id)->get();
          $ventas = Venta::where('razonSocial', '=', $razon->id)->get();

          $valor =  [  'nombre' => $razon->nombre,'solicitudes' => $solicitudes,  'cotizaciones' => $cotizaciones, 'ventas' => $ventas ];

            array_push($tablita, $valor);

         }
         

        
        

            
          

    return response()->json(['response' => $tablita],200);
  }

  public function getSolicitantesDasboard(){
   

         $solicitantes = Solicitante::orderBy('id', 'DESC')->get();
         $clientes = Cliente::orderBy('id', 'DESC')->get();

        $tablita = [];
        foreach ($solicitantes as $solicitante) {

          foreach($clientes as $cliente){

            $solicitudes = Solicitud::where('solicitante', '=', $solicitante->id)
            ->where('cliente', '=', $cliente->id)
           ->get();
            

            $cotizaciones = Cotizacion::where('idSolicitante', '=', $solicitante->id)
             ->where('idCliente', '=', $cliente->id)
           ->get();
            

             $ventas = Venta::where('idSolicitante', '=', $solicitante->id)
             ->where('idCliente', '=', $cliente->id)
           ->get();

            $valor =  [  'nombre' => $solicitante->nombre,'razonsocial' => $cliente->razonSocial,  'solicitudes' => $solicitudes, 'cotizaciones' => $cotizaciones, 'ventas' => $ventas ];

            array_push($tablita, $valor);
          }


    }

    return response()->json(['response' => $tablita],200);
  }
    public function createSolicitante(Request $request)
    {
      try {
        if ($request) {
          DB::beginTransaction();
          $solicitante = new Solicitante();
          $solicitante->nombre = $request->nombre;
          $solicitante->email = $request->email;
          $solicitante->telefono = $request->telefono;
          $solicitante->save();
          DB::commit();
        }

      } catch (Exception $e) {
      DB::rollBack();
        return response()->json(['response' => $e],500);
      }
      return response()->json(['response' => true ],200);
    }

    public function getSolicitantes()
    {
      try {

          $Solicitantes = Solicitante::orderBy('id', 'DESC')->get();

      } catch (Exception $e) {

        return response()->json(['response' => $e],500);
      }
      return response()->json(['response' => $Solicitantes ],200);
    }

    public function getSolicitante(Request $request)
    {
      try {

          $Solicitante = Solicitante::where('id', '=', $request->id )->first();

      } catch (Exception $e) {

        return response()->json(['response' => $e],500);
      }
      return response()->json(['response' => $Solicitante ],200);
    }

    public function editarSolicitante ( Request $request ) {
      try {
        DB::beginTransaction();
        $solicitante = Solicitante::where('id', '=', $request->id )->first();

       $solicitante->nombre = $request->nombre;
       $solicitante->email = $request->email;
       $solicitante->telefono = $request->telefono;

       $solicitante->save();
        DB::commit();


      } catch (Exception $e) {
        DB::rollBack();
          return response()->json(['response' => $e],500);
      }
        return response()->json(['response' => true],200);
    }
}
