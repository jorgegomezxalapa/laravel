<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\RazonSocial;
use App\Formato;
use App\Documento;
use Storage;


class GestionController extends Controller
{
    public function nuevaRazon (Request $request) {
        try {
            $sql = new RazonSocial();
            $sql->nombre = $request->nombre;
            $sql->descripcion = $request->descripcion;
            $sql->save();
            return "ok";
        } catch (Exception $e) {
            
        }

    }

    public function getRazon (Request $request) {
        try {
            $sql = RazonSocial::all();
            return response()->json(['response' => $sql],200);
            
        } catch (Exception $e) {
            
        }

    }

    public function editarRazon (Request $request) {
    	
    }

    public function nuevoFormato (Request $request) {
        try {
            $sql = new Formato();
            $sql->nombre = $request->nombre;
            $sql->descripcion = $request->descripcion;
            $sql->save();
            return "ok";
        } catch (Exception $e) {
            
        }
    	
    }

    public function getFormato (Request $request) {
        try {
            $sql = Formato::all();
            return response()->json(['response' => $sql],200);
            
        } catch (Exception $e) {
            
        }

    }

    public function getDocumento (Request $request) {
        try {
            $sql = Documento::with('razonsocial')->with('formato')->get();
            return response()->json(['response' => $sql],200);
            
        } catch (Exception $e) {
            
        }

    }

    public function getDocumentosF (Request $request) {
        try {
            $sql = Documento::where('id_razonsocial','=', $request->id_razonsocial)->where('id_formato','=', $request->id_formato)->get();
            return response()->json(['response' => $sql],200);
            
        } catch (Exception $e) {
            
        }

    }

    public function editarFormato (Request $request) {

    }

    public function nuevoDocumento (Request $request) {
       
    	try {
            $sql = new Documento();
            $sql->nombre = $request->nombre;
            $sql->descripcion = $request->descripcion;
            $sql->id_razonsocial = ($request->id_razonsocial == "null") ? null : $request->id_razonsocial;
            $sql->id_formato = ($request->id_formato == "null") ? null : $request->id_formato;

            if(  isset ( $request->archivo ) ){
                $nombreConcatenado = null;
                foreach($request->archivo as $archivo){
                $nombre = $archivo->getClientOriginalName();
                if($nombreConcatenado != null){
                    $nombreConcatenado = $nombreConcatenado.','.$nombre;
                }else{
                    $nombreConcatenado = $nombre;
                }
               
                $carpeta = 'documentos/'.$request->id_razonsocial.'/'.$request->id_formato;
                $path = Storage::putFileAs(
                    $carpeta, $archivo, $nombre
                );
                }
                $sql->documento = $nombreConcatenado;
               

            }
            $sql->save();
            return "ok";
        } catch (Exception $e) {
            
        }
    }

    public function editarDocumento (Request $request) {
    	
    }
}
