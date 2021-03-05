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
        'politicas',

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
        'disponible',
        'solicitadas',



      ];

      function cotizacion(){
          return $this->hasOne('App\Cotizacion','id','idCotizacion');
      }
}
