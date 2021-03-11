<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Almacen extends Model
{
  protected $table = 'productos';
    protected $fillable =[
    'id',
    'idSegmento',
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


}
