<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Partida extends Model
{
    //
    protected $table = 'partidas';
      protected $fillable =[


      'id',
          'partida',
            'descripcion',
              'unidadmedida',
                'cantidad',
                  'precioproveedor',
                    'utilidaddefault',
                      'iva',
                        'ieps',
                          'importe1',
                            'utilidadgenerada',
                              'preciounitario',
                                'importe2',
                                  'idCotizacion',



      ];

      // function solicitud(){
      //     return $this->hasOne('App\Solicitud','id','idSolicitud');
      // }
}
