<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Solicitante extends Model
{
    //
    protected $table = 'solicitantes';
      protected $fillable =[
          'id',
          'nombre',
          'email',
          'telefono',
      ];

      // function municipio(){
      //     return $this->hasOne('App\Models\CatMunicipio','cve_mun','municipio');
      // }
}
