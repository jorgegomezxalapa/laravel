<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Utilidad extends Model
{
    //
    protected $table = 'utilidades';
      protected $fillable =[
          'id',
          'descripcion',
          'porcentaje',

          'created_at',
          'updated_at'

      ];

      // function agente(){
      //     return $this->hasOne('App\User','id','agente');
      // }
}
