<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Venta extends Model
{
    //
     protected $table = 'ventas';
      protected $fillable =[

            'id',
            	'idCotizacion',
	            'subtotal',
	            'iva',
	            'ieps',
	            'total',
	            'disponiblecompra',
	            'disponiblecompraEvidencia',
	            'comprada',
	            'compradaEvidencia',
	            'disponibleentrega',
	            'disponibleentregaEvidencia',
	            'entregada',
	            'entregadaEvidencia',
	            'disponiblefactura',
	            'disponiblefacturaEvidencia',
	            'facturada',
	            'facturadaEvidencia',
	            'cobrada',
	            'cobradaEvidencia',
	            'cobradasf',
	            'cobradasfEvidencia', 


      ];
      function cotizacion(){
          return $this->hasOne('App\Cotizacion','id','idCotizacion');
      }
}
