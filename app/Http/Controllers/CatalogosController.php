<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Solicitante;
use App\Cliente;
use App\User;


class CatalogosController extends Controller
{
    //
    public function catalogosSolicitud () {
      try {

        $agentes = User::orderBy('id', 'DESC')->where('rol', '=', 'ADMINISTRADOR')->orWhere('rol', '=', 'AGENTE')->get();
        $clientes = Cliente::orderBy('id', 'DESC')->get();
        $solicitantes = Solicitante::orderBy('id', 'DESC')->get();
        $responsables = User::orderBy('id', 'DESC')->where('rol', '!=', 'AGENTE')->get();


        return response()->json(['agentes' => $agentes, 'clientes' => $clientes, 'solicitantes' => $solicitantes, 'responsables' => $responsables],200);

      } catch (Exception $e) {
        return response()->json(['response' => $e],500);

      }
    }
}
