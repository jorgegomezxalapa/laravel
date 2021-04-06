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
            'disponiblecompra',
            'disponiblefactura',
            'comprada',
            'disponibleentrega',
            'entregada',
            'cobrada',
            'disponiblecompraEvidencia',
            'disponiblefacturaEvidencia',
            'compradaEvidencia',
            'disponibleentregaEvidencia',
            'entregadaEvidencia',
            'cobradaEvidencia',
          'fechafinalizado'


      ];

      function solicitud(){
          return $this->hasOne('App\Solicitud','id','idSolicitud');
      }
      function utilidad(){
          return $this->hasOne('App\Utilidad','id','utilidadGlobal');
      }
      public function partidas()
    {
        return $this->hasMany('App\Partida','idCotizacion');
    }

//     public function post()
// {
//     return $this->belongsTo(Post::class, 'foreign_key', 'owner_key');
// }


}
