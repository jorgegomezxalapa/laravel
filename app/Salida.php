<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Salida extends Model
{
  protected $table = 'salidas';
    protected $fillable =[
      'id',
      'idProducto',
      'idEmpleado',
      'idCotizacion',
      'cantidad',
      'concepto',
      'evidencias',
    ];
}
