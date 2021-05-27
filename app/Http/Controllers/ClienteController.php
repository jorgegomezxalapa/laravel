<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Cliente;
use App\Solicitud;
use App\Venta;
use App\Cotizacion;

class ClienteController extends Controller
{

  public function filtrarBusquedaClientes(Request $request){
      try {
        $anio = $request->anio;
        $mes = $request->mes;

        $clientes = Cliente::orderBy('id', 'DESC')->get();

        $tablita = [];
        foreach ($clientes as $cliente) {

          $solicitudes = Solicitud::where('cliente', '=', $cliente->id)
          ->whereYear('created_at', $anio)
          ->whereMonth('created_at', $mes)->get();
          

          $cotizaciones = Cotizacion::where('idCliente', '=', $cliente->id)
          ->whereYear('created_at', $anio)
          ->whereMonth('created_at', $mes)->get();
          

           $ventas = Venta::where('idCliente', '=', $cliente->id)
          ->whereYear('created_at', $anio)
          ->whereMonth('created_at', $mes)->get();
         
          

          $valor =  [  'nombre' => $cliente->razonSocial,  'solicitudes' => $solicitudes, 'cotizaciones' => $cotizaciones, 'ventas' => $ventas ];

         array_push($tablita, $valor);
        }
      } catch (\Exception $e) {
        DB::rollBack();
          return response()->json(['response' => $e],500);
      }
      return response()->json(['response' => $tablita],200);

    }


  public function createCliente(Request $request)
  {
    try {
      if ($request) {

        DB::beginTransaction();
        $user = new Cliente();
        $user->razonSocial = $request->razonSocial;
        $user->representante = $request->representante;
        $user->cargoRepresentante = $request->cargoRepresentante;
        $user->cargoConAtencion = $request->cargoConAtencion;
        $user->conatencion = $request->conatencion;
        $user->rfc = $request->rfc;
        $user->email = $request->email;
        $user->telefono = $request->telefono;
        $user->save();
        DB::commit();
      }

    } catch (Exception $e) {
    DB::rollBack();
      return response()->json(['response' => $e],500);
    }
    return response()->json(['response' => true],200);
  }

    public function getClientes(){
      try {
        $clientes = Cliente::orderBy('id', 'DESC')->get();
      } catch (\Exception $e) {
        DB::rollBack();
          return response()->json(['response' => $e],500);
      }
return response()->json(['response' => $clientes],200);

    }

     public function getClientesDasboard(){
      try {

        $clientes = Cliente::orderBy('id', 'DESC')->get();
        $tablita = [];
        foreach ($clientes as $cliente) {

          $solicitudes = Solicitud::where('cliente', '=', $cliente->id)->get();
          $cotizaciones = [];

          foreach ($solicitudes as $solicitud) {
            $cotizacion = Cotizacion::where('idSolicitud', '=', $solicitud->id)->first();
            if ($cotizacion != null) {
              array_push($cotizaciones, $cotizacion);
            }
            
          }
          $ventas = [];
         foreach($cotizaciones as $cotizacion){
          $venta = Venta::where('idCotizacion','=',$cotizacion->id)->first();
          if ($venta != null) {
            array_push($ventas, $venta);
          }
          
         }
         

          $valor =  [  'nombre' => $cliente->razonSocial,  'solicitudes' => $solicitudes, 'cotizaciones' => $cotizaciones, 'ventas' => $ventas ];

         array_push($tablita, $valor);
        }
      } catch (\Exception $e) {
        DB::rollBack();
          return response()->json(['response' => $e],500);
      }
      return response()->json(['response' => $tablita],200);

    }

    public function getCliente(Request $request){
      try {
        $cliente = Cliente::where('id', '=', $request->id)->first();
      } catch (\Exception $e) {
        DB::rollBack();
          return response()->json(['response' => $e],500);
      }
return response()->json(['response' => $cliente],200);

    }

    public function editarCliente(Request $request){
      
      try {
        DB::beginTransaction();
        $cliente = Cliente::where('id', '=', intval($request->id) )->first();

         $cliente->razonSocial = $request->razonSocial;
         $cliente->representante = $request->representante;
         $cliente->cargoRepresentante = $request->cargoRepresentante;
        $cliente->cargoConAtencion = $request->cargoConAtencion;
         $cliente->conatencion = $request->conatencion;
         $cliente->rfc = $request->rfc;
         $cliente->email = $request->email;
         $cliente->telefono = $request->telefono;
         $cliente->save();
        DB::commit();
       
       
      } catch (\Exception $e) {
        DB::rollBack();
          return response()->json(['response' => $e],500);
      }
      return response()->json(['response' =>"ok"],200);

    }
}
