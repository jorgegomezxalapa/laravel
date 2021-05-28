<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Historial extends Model
{
    //
     protected $table = 'historial';
      protected $fillable =[
          'id',
        'idUsuario', 
        'accion',
        'modulo',
        'descripcion',
        'created_at'

      ];
}
