<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Solicitud extends Model
{
    //
    protected $table = 'solicitudes';
      protected $fillable =[
          'id',
          'fecha',
          'folio',
          'agente',
          'cliente',
          'solicitante',
          'responsable',
          'comentarios',
          'created_at',
          'updated_at'

      ];

      // function municipio(){
      //     return $this->hasOne('App\Models\CatMunicipio','cve_mun','municipio');
      // }
}
