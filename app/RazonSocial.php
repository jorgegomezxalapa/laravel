<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RazonSocial extends Model
{
     protected $table = 'razonsocial';
      protected $fillable =[

           'id',
           'nombre',
           'descripcion',


      ];
}
