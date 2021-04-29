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
            $registro->idCotizacion = $idCotizacion;
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
