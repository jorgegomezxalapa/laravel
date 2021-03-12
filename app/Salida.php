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

    function producto(){
        return $this->hasOne('App\Almacen','id','idProducto');
    }
    function empleado(){
        return $this->hasOne('App\User','id','idEmpleado');
    }
}
