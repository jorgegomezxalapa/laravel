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
          'fechafinalizado',


      ];

      function solicitud(){
          return $this->hasOne('App\Solicitud','id','idSolicitud');
      }


}
