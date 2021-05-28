<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Venta;
use App\Cotizacion;
class VentasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function turnarVenta(Request $request)
    {
        //
        
        $idCotizacion = intval($request->idCotizacion);

        $venta = Venta::where('idCotizacion','=',$idCotizacion)->count();

        
        if ($venta == 0) {
            $cotizacion = Cotizacion::where('id','=',$idCotizacion)->first();
            $registro = new Venta();
            $registro->razonSocial = $cotizacion->razonSocial;
            $registro->idCotizacion = $idCotizacion;
            $registro->idCliente = $cotizacion->idCliente;
            $registro->idSolicitante = $cotizacion->idSolicitante;
            $registro->subtotal = $cotizacion->subtotal; 
            $registro->iva = $cotizacion->ivaTotal;
            $registro->ieps = $cotizacion->iepsTotal;
            $registro->total = $cotizacion->total;
            $registro->save();
            return response()->json(['response' => 1],200);
        }else{
            //ya fue turnada
            return response()->json(['response' => 2],200);
        }
        
    }

     public function getVentas()
    {
        //
        
      

        $ventas = Venta::with('cotizacion.solicitud')->get();

        
       
            return response()->json(['response' => $ventas],200);
        
        
    }

    public function getVenta(Request $request)
    {
       $id = $request->id;
        $venta = Venta::where('id', '=', $id)->first();

        return response()->json(['response' => $venta],200);
        
    }

    public function updateVenta(Request $request)
    {
        $id = $request->id;
        $columna = $request->columna;
        $valor = $request->valor;
        $carpeta = "";
        $nombreConcatenado = null;
        $venta = Venta::where('id', '=', $id)->first();
         if(  isset ( $request->archivo ) ){
        switch ($columna) {
                case 1:
                   
                    $carpeta = "disponiblecompra";
                    break;
                case 2:
                       
                        $carpeta = "comprada";
                    break;
                case 3:
                        
                        $carpeta = "disponibleentrega";
                    break;
                case 4:
                   
                    $carpeta = "entregada";
                    break;
                case 5:
                  
                    $carpeta = "disponiblefactura";
                    break;
                case 6:
                  
                    $carpeta = "facturada";
                    break;
                case 7:
                   
                    $carpeta = "cobrada";
                    break;
                case 8:
                   
                    $carpeta = "cobradasf";
                    break;
        }
                
                foreach($request->archivo as $archivo){
                $nombre = $archivo->getClientOriginalName();
                if($nombreConcatenado != null){
                    $nombreConcatenado = $nombreConcatenado.','.$nombre;
                }else{
                    $nombreConcatenado = $nombre;
                }
                $path = $archivo->storeAs(
                'ventas/'.$id.'/'.$carpeta,  $nombre
                );
                }
                

        }
        
        switch ($columna) {
            case 1:
                $venta->disponiblecompra = $valor;
                $venta->disponiblecompraEvidencia = $nombreConcatenado;
                break;
            case 2:
                $venta->comprada = $valor;
                $venta->compradaEvidencia = $nombreConcatenado;
                break;
            case 3:
                $venta->disponibleentrega = $valor;
                $venta->disponibleentregaEvidencia = $nombreConcatenado;
                break;
            case 4:
                $venta->entregada = $valor;
                $venta->entregadaEvidencia = $nombreConcatenado;
                break;
            case 5:
                $venta->disponiblefactura = $valor;
                $venta->disponiblefacturaEvidencia = $nombreConcatenado;
                break;
            case 6:
                $venta->facturada = $valor;
                $venta->facturadaEvidencia = $nombreConcatenado;
                break;
            case 7:
                $venta->cobrada = $valor;
                $venta->cobradaEvidencia = $nombreConcatenado;
                break;
            case 8:
                $venta->cobradasf = $valor;
                $venta->cobradasfEvidencia = $nombreConcatenado;
                break;
        }
        
        $venta->save();

        return response()->json(['response' => $venta],200);
        
    }

    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
