<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Cliente;

class ClienteController extends Controller
{
  public function createCliente(Request $request)
  {
    try {
      if ($request) {

        DB::beginTransaction();
        $user = new Cliente();
        $user->razonSocial = $request->razonSocial;
        $user->representante = $request->representante;
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
        $cliente = Cliente::where('id', '=', $request->id )->first();

       $cliente->razonSocial = $request->razonSocial;
       $cliente->representante = $request->representante;
         $user->conatencion = $request->conatencion;
       $cliente->rfc = $request->rfc;
       $cliente->email = $request->email;
       $cliente->telefono = $request->telefono;
       $cliente->save();
        DB::commit();
      } catch (\Exception $e) {
        DB::rollBack();
          return response()->json(['response' => $e],500);
      }
return response()->json(['response' =>true],200);

    }
}
