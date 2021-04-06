<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Almacen extends Model
{
  protected $table = 'productos';
    protected $fillable =[
    'id',
    'esMejora',
    'esSolicitud',
    'idSegmento',
    'idEmpleado',
    'descripcion',
    'unidaddemedida',
    'cantidad',
    'disponible',
    'preciodelproveedor',
    'marca',
    'modelo',
    'numerodeserie',
    'politicasdegarantia',
    'notasdelproducto',
    'archivosdenotas',
    'miniatura',
    ];

    function segmento(){
        return $this->hasOne('App\Segmento','id','idSegmento');
    }
    function empleado(){
        return $this->hasOne('App\User','id','idEmpleado');
    }

     public function partida()
    {
        return $this->belongsTo('App\Partida', 'id', 'idProducto');
    }


}
