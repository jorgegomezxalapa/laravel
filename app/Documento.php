<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Documento extends Model
{
    //
    protected $table = 'documentos';
      protected $fillable =[

          'id',
           'nombre',
           'descripcion',
            'id_razonsocial',
            'id_formato',
            'documento',


      ];

      function razonsocial(){
          return $this->hasOne('App\RazonSocial','id','id_razonsocial');
      }
      function formato(){
          return $this->hasOne('App\Formato','id','id_formato');
      }
}
