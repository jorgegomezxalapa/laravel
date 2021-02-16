<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cotizacion extends Model
{
    //
    protected $table = 'cotizaciones';
      protected $fillable =[

            'id',
            'idSolicitud',
            'estatus',
            'utilidadGlobal',
            'ivaGlobal',
            'iepsGlobal',
            'ivaTotal',
            'iepsTotal',
            'subtotal',
            'total',
          'fechafinalizado'


      ];

      function solicitud(){
          return $this->hasOne('App\Solicitud','id','idSolicitud');
      }
      function utilidad(){
          return $this->hasOne('App\Utilidad','id','idUtilidad');
      }


}
