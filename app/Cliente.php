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
        'conatencion',
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
