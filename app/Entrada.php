<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Entrada extends Model
{
  protected $table = 'entradas';
    protected $fillable =[
      'id',
      'idProducto',
      'idEmpleado',
      'idCotizacion',
      'cantidad',
      'concepto',
      'evidencias',
    ];

    function producto(){
        return $this->hasOne('App\Almacen','id','idProducto');
    }

    function responsable(){
        return $this->hasOne('App\User','id','idEmpleado');
    }
}
