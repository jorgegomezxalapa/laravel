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
        'cargoRepresentante',
        'conatencion',
        'cargoConAtencion',
        'rfc',
        'email',
        'telefono',
        'created_at',
        'updated_at'

    ];

     public function solicitud()
    {
        return $this->belongsTo('App\Solicitud', 'id', 'cliente');
    }
}
