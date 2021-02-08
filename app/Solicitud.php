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
          'urgente',
          'created_at',
          'updated_at'

      ];

      function agente(){
          return $this->hasOne('App\User','id','agente');
      }

      function cliente(){
          return $this->hasOne('App\Cliente','id','cliente');
      }

      function solicitante(){
          return $this->hasOne('App\Solicitante','id','solicitante');
      }

      function responsable(){
          return $this->hasOne('App\User','id','responsable');
      }
}
