<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
  protected $table = 'clientes';
    protected $fillable =[
        'id',
        'razonSocial',
        'representante',
        'rfc',
        'email',
        'telefono',
        'created_at',
        'updated_at'

    ];

    // function municipio(){
    //     return $this->hasOne('App\Models\CatMunicipio','cve_mun','municipio');
    // }
}
