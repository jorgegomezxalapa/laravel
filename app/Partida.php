<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Partida extends Model
{
    //
    protected $table = 'partidas';
      protected $fillable =[


        'id',
        'idCotizacion',

        'partida',
        'descripcion',
        'unidadmedida',
        'cantidad',
        'precioproveedor',

        'marca',
        'modelo',
        'numserie',

        'ivapartida',
        'iepspartida',
        'utilidadpartida',

        'notasproducto',

        'importe1',
        'utilidadgenerada',
        'preciounitario',
        'importe2',



      ];

      // function solicitud(){
      //     return $this->hasOne('App\Solicitud','id','idSolicitud');
      // }
}
