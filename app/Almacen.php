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
    'preciodelproveedor',
    'marca',
    'modelo',
    'numerodeserie',
    'politicasdegarantia',
    'notasdelproducto',
    'archivosdenotas',
    'miniatura',
    ];


}
