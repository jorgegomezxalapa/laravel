<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Segmento extends Model
{
  protected $table = 'segmentos';
    protected $fillable =[

          'id',
          'nombre',
          'descripcion',

    ];
}
