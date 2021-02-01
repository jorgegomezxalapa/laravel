<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Solicitante;

class SolicitantesController extends Controller
{
    //
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
