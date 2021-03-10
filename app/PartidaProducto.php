<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PartidaProducto extends Model
{
  protected $table = 'partidas_productos';
    protected $fillable =[

          'id',
          'idPartida',
          'idProducto',

    ];

}
